<?php

/***************************************
Ptyxis Comic CMS
Copyright (C) 2015 Mark Kestler ptyxis.cthonic.com


GNU General Public License, version 2

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License version 2
as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

version 0.1.0
****************************************/


if(file_exists('app/config/config.php')) {
    require 'app/config/config.php';
} else {
    $missingConfig = True;
}

require 'app/lib/Slim/Slim.php';

require 'app/lib/Ptyxis/PtyxisSessions.php';
require 'app/lib/Ptyxis/PtyxisValidation.php';
require 'app/lib/Ptyxis/PtyxisMySQL.php';
require 'app/lib/Ptyxis/PtyxisUpload.php';
require 'app/lib/Ptyxis/PtyxisRSS.php';

require 'app/models/BaseModel.php';
require 'app/models/ChapterModel.php';
require 'app/models/ComicModel.php';
require 'app/models/UserModel.php';
require 'app/models/SettingModel.php';

require 'app/controllers/BaseController.php';
require 'app/controllers/AdminController.php';
require 'app/controllers/ChapterController.php';
require 'app/controllers/ComicController.php';
require 'app/controllers/UserController.php';
require 'app/controllers/SettingController.php';
require 'app/controllers/InstallController.php';

\Slim\Slim::registerAutoloader();

$logWriter = new \Slim\LogWriter(fopen('log', 'a'));

$app = new \Slim\Slim();

$app->config(array(
    'debug' => false,
    'log.enabled' => false,
    'log.writer' => $logWriter,
    'templates.path' => 'app/templates'
));



// GET route
$app->get(
    '/feed',
    function () use ($app)  {
      $app->contentType("text/xml");
      $comicController = new ComicController();
      $data = $comicController->feed();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->get(
    '/about',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->about();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->get(
    '/',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->view();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->get(
    '/settings/theme',
    function () use ($app)  {

      $settingController = new SettingController();
      $data = $settingController->theme();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->post(
    '/settings/theme',
    function () use ($app)  {

      $settingController = new SettingController();
      $data = $settingController->theme();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->get(
    '/settings/content',
    function () use ($app)  {

      $settingController = new SettingController();
      $data = $settingController->content();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->post(
    '/settings/content',
    function () use ($app)  {

      $settingController = new SettingController();
      $data = $settingController->content();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->get(
    '/settings',
    function () use ($app)  {

      $settingController = new SettingController();
      $data = $settingController->settings();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->post(
    '/settings',
    function () use ($app)  {

      $settingController = new SettingController();
      $data = $settingController->settings();

      $app->render($data['layout'].'.php', $data);
    }
);

// GET route
$app->get(
    '/dashboard',
    function () use ($app)  {

      $adminController = new AdminController();
      $data = $adminController->dashboard();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/chapters',
    function () use ($app)  {

      $chapterController = new ChapterController();
      $data = $chapterController->chapters();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/chapter/new',
    function () use ($app)  {

      $chapterController = new ChapterController();
      $data = $chapterController->add();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->post(
    '/chapter/new',
    function () use ($app)  {

      $chapterController = new ChapterController();
      $data = $chapterController->add();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/chapter/edit/:id',
    function ($id) use ($app)  {

      $chapterController = new ChapterController();
      $data = $chapterController->edit($id);

      $app->render($data['layout'].'.php', $data);
    }
);

$app->post(
    '/chapter/edit',
    function () use ($app)  {

      $chapterController = new ChapterController();
      $data = $chapterController->edit();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->post(
    '/chapter/delete',
    function () use ($app)  {

      $chapterController = new ChapterController();
      $data = $chapterController->delete();

      $app->render($data['layout'].'.php', $data);
    }
);


$app->get(
    '/comic/:slug',
    function ($slug) use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->view($slug);

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/archive',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->archive();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/comics',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->comics();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/comics/new',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->add();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->post(
    '/comics/new',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->add();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/comics/edit/:id',
    function ($id) use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->edit($id);

      $app->render($data['layout'].'.php', $data);
    }
);

$app->post(
    '/comics/edit',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->edit();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->post(
    '/comics/delete',
    function () use ($app)  {

      $comicController = new ComicController();
      $data = $comicController->delete();

      $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/user/login',
    function () use ($app) {

        $userController = new UserController();
        $data = $userController->login();

        $app->render($data['layout'].'.php', $data);
    }
);

// POST route
$app->post(
    '/user/login',
    function () use ($app) {
        $userController = new UserController();
        $data = $userController->login();

        $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/user/logout',
    function () use ($app) {

        $userController = new UserController();
        $data = $userController->logout();

    }
);

$app->get(
    '/user/profile',
    function () use ($app) {

        $userController = new UserController();
        $data = $userController->profile();

        $app->render($data['layout'].'.php', $data);
    }
);

// POST route
$app->post(
    '/user/profile',
    function () use ($app) {
        $userController = new UserController();
        $data = $userController->profile();

        $app->render($data['layout'].'.php', $data);
    }
);

// POST route
$app->post(
    '/user/changepassword',
    function () use ($app) {
        $userController = new UserController();
        $data = $userController->changepassword();

        $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/user/resetpassword/:id/:token',
    function ($id, $token) use ($app) {
        $userController = new UserController();
        $data = $userController->resetpassword($id, $token);

        $app->render($data['layout'].'.php', $data);
    }
);

$app->get(
    '/user/forgotpassword',
    function () use ($app) {
        $userController = new UserController();
        $data = $userController->forgotpassword();

        $app->render($data['layout'].'.php', $data);
    }
);

// POST route
$app->post(
    '/user/forgotpassword',
    function () use ($app) {
        $userController = new UserController();
        $data = $userController->forgotpassword();

        $app->render($data['layout'].'.php', $data);
    }
);


$app->get(
    '/install',
    function () use ($app) {
        $installController = new InstallController();
        $data = $installController->install();

        $app->render($data['layout'].'.php', $data);
    }
);

// POST route
$app->post(
    '/install',
    function () use ($app) {
        $installController = new InstallController();
        $data = $installController->install();

        $app->render($data['layout'].'.php', $data);
    }
);

if(file_exists('extensions.php')) {
    require 'extensions.php';
}

$app->run();
