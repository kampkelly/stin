<?php

  function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->is_permission);
    foreach ($permissions as $key => $value) {
      if($value == $userAccess){
        return true;
      }
    }
    return false;
  }

  function getMyPermission($id)
  {
    switch ($id) {
      case 1:
        return 'investor';
        break;
      case 2:
        return 'innovator_upgrade';
        break;
      case 3:
        return 'investor_upgrade';
        break;
      case 4:
        return 'admin';
        break;
      case 5:
        return 'superadmin';
        break;
      default:
        return 'innovator';
        break;
    }
  }

?>
