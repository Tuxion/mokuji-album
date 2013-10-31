<?php namespace components\album; if(!defined('MK')) die('No direct access.');

//Make sure we have the things we need for this class.
mk('Component')->check('update');

class DBUpdates extends \components\update\classes\BaseDBUpdates
{
  
  protected
    $component = 'album',
    $updates = array(
    );

  public function install_0_0_1_alpha($dummydata, $forced)
  {
    
    if($forced === true){
      mk('Sql')->query('DROP TABLE IF EXISTS `#__album_albums`');
      mk('Sql')->query('DROP TABLE IF EXISTS `#__album_albums_to_pages`');
      mk('Sql')->query('DROP TABLE IF EXISTS `#__album_album_items`');
    }
    
    mk('Sql')->query('
      CREATE TABLE `#__album_albums` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `is_secret` bit(1) NOT NULL DEFAULT b\'0\',
        `is_locked` bit(1) NOT NULL DEFAULT b\'0\',
        PRIMARY KEY (`id`)
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    ');
    
    mk('Sql')->query('
      CREATE TABLE `#__album_albums_to_pages` (
        `page_id` int(10) unsigned NOT NULL,
        `album_id` int(10) unsigned NOT NULL,
        `order_id` int(10) unsigned NOT NULL,
        PRIMARY KEY (`page_id`, `album_id`)
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    ');
    
    mk('Sql')->query('
      CREATE TABLE `#__album_album_items` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `album_id` int(10) unsigned NOT NULL,
        `image_id` int(10) unsigned NOT NULL,
        `order_id` int(10) unsigned NOT NULL,
        `caption` TEXT NULL DEFAULT NULL,
        PRIMARY KEY (`id`),
        INDEX `album_id` (`album_id`),
        INDEX `order_id` (`album_id`, `order_id`)
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    ');
    
  }
  
}

