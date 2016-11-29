<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

$nh = Core::make('helper/navigation');

$page = Page::getByID($attributeCID);
foreach($attributeList as $ak => $attribute){
  foreach($attribute as $key => $value){
    if($key == 'name'){
      echo '<h3>' . $value . '</h3>';
    }
    if($key=='values'){
      foreach($value as $akid => $val){
        $link = $nh->getLinkToCollection($page) . '?attribute-filter[' . $ak . '][]=' . $akid;
        echo '<a href="' . $link . '">' .  $val . '</a><br>';
      }
    }
  }
}
?>
