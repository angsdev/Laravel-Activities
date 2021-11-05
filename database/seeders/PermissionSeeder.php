<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){

    Permission::factory()->createMany([
      // Users
      [
        'name' => 'view any user',
        'description' => 'Permission that allow see any user.'
      ],
      [
        'name' => 'view user',
        'description' => 'Permission that allow see own user.'
      ],
      [
        'name' => 'create user',
        'description' => 'Permission that allow create an user.'
      ],
      [
        'name' => 'update any user',
        'description' => 'Permission that allow update any user.'
      ],
      [
        'name' => 'update user',
        'description' => 'Permission that allow update own view.'
      ],
      [
        'name' => 'delete any user',
        'description' => 'Permission that allow delete any user.'
      ],
      [
        'name' => 'delete user',
        'description' => 'Permission that allow delete own user.'
      ],
      // Roles
      [
        'name' => 'view any role',
        'description' => 'Permission that allow see any role.'
      ],
      [
        'name' => 'view role',
        'description' => 'Permission that allow see own role.'
      ],
      [
        'name' => 'create role',
        'description' => 'Permission that allow create role.'
      ],
      [
        'name' => 'update role',
        'description' => 'Permission that allow update role.'
      ],
      [
        'name' => 'delete role',
        'description' => 'Permission that allow delete role.'
      ],
      // Permissions
      [
        'name' => 'view any permission',
        'description' => 'Permission that allow see any permission.'
      ],
      [
        'name' => 'view permission',
        'description' => 'Permission that allow see own permission.'
      ],
      [
        'name' => 'create permission',
        'description' => 'Permission that allow create permission.'
      ],
      [
        'name' => 'update permission',
        'description' => 'Permission that allow update permission.'
      ],
      [
        'name' => 'delete permission',
        'description' => 'Permission that allow delete permission.'
      ],
      // Images
      [
        'name' => 'view any image',
        'description' => 'Permission that allow see any image.'
      ],
      [
        'name' => 'view image',
        'description' => 'Permission that allow see own image.'
      ],
      [
        'name' => 'create image',
        'description' => 'Permission that allow create an image.'
      ],
      [
        'name' => 'update any image',
        'description' => 'Permission that allow update any image.'
      ],
      [
        'name' => 'update image',
        'description' => 'Permission that allow update own image.'
      ],
      [
        'name' => 'delete any image',
        'description' => 'Permission that allow delete any image.'
      ],
      [
        'name' => 'delete image',
        'description' => 'Permission that allow delete own image.'
      ],
      // Activities
      [
        'name' => 'view any activity',
        'description' => 'Permission that allow see any activity.'
      ],
      [
        'name' => 'view activity',
        'description' => 'Permission that allow see own activity.'
      ],
      [
        'name' => 'create activity',
        'description' => 'Permission that allow create an activity.'
      ],
      [
        'name' => 'update any activity',
        'description' => 'Permission that allow update any activity.'
      ],
      [
        'name' => 'update activity',
        'description' => 'Permission that allow update own activity.'
      ],
      [
        'name' => 'delete any activity',
        'description' => 'Permission that allow delete any activity.'
      ],
      [
        'name' => 'delete activity',
        'description' => 'Permission that allow delete own activity.'
      ],
      // Activity attentions
      [
        'name' => 'view any activity attention',
        'description' => 'Permissions that allow see any activity attention.'
      ],
      [
        'name' => 'view activity attention',
        'description' => 'Permissions that allow own activity attention.'
      ],
      [
        'name' => 'create activity attention',
        'description' => 'Permissions that allow create activity attention.'
      ],
      [
        'name' => 'update activity attention',
        'description' => 'Permissions that allow update activity attention.'
      ],
      [
        'name' => 'delete activity attention',
        'description' => 'Permissions that allow delete activity attention.'
      ],
      // Activity types
      [
        'name' => 'view any activity type',
        'description' => 'Permission that allow see any activity type.'
      ],
      [
        'name' => 'view activity type',
        'description' => 'Permission that allow see own activity type.'
      ],
      [
        'name' => 'create activity type',
        'description' => 'Permission that allow create activity type.'
      ],
      [
        'name' => 'update activity type',
        'description' => 'Permission that allow update activity type.'
      ],
      [
        'name' => 'delete activity type',
        'description' => 'Permission that allow delete activity type.'
      ],
      // Activity process
      [
        'name' => 'view any activity process',
        'description' => 'Permission that allow see any activity process.'
      ],
      [
        'name' => 'view activity process',
        'description' => 'Permission that allow see own activity process.'
      ],
      [
        'name' => 'create activity process',
        'description' => 'Permission that allow create activity process.'
      ],
      [
        'name' => 'update activity process',
        'description' => 'Permission that allow update activity process.'
      ],
      [
        'name' => 'delete activity process',
        'description' => 'Permission that allow delete activity process.'
      ],
      // Activity sources
      [
        'name' => 'view any activity source',
        'description' => 'Permission that allow see any activity process.'
      ],
      [
        'name' => 'view activity source',
        'description' => 'Permission that allow see own activity process.'
      ],
      [
        'name' => 'create activity source',
        'description' => 'Permission that allow create activity process.'
      ],
      [
        'name' => 'update activity source',
        'description' => 'Permission that allow update activity process.'
      ],
      [
        'name' => 'delete activity source',
        'description' => 'Permission that allow delete activity process.'
      ],
      // Activity identifiers
      [
        'name' => 'view any activity identifier',
        'description' => 'Permission that allow see any activity identifier.'
      ],
      [
        'name' => 'view activity identifier',
        'description' => 'Permission that allow see own activity identifier.'
      ],
      [
        'name' => 'create activity identifier',
        'description' => 'Permission that allow create activity identifier.'
      ],
      [
        'name' => 'update activity any identifier',
        'description' => 'Permission that allow update any activity identifier.'
      ],
      [
        'name' => 'update activity identifier',
        'description' => 'Permission that allow update own activity identifier.'
      ],
      [
        'name' => 'delete any activity identifier',
        'description' => 'Permission that allow delete any activity identifier.'
      ],
      [
        'name' => 'delete activity identifier',
        'description' => 'Permission that allow delete own activity identifier.'
      ]
    ]);
  }
}
