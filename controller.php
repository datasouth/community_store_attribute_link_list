<?php

namespace Concrete\Package\CommunityStoreAttributeLinkList;

use Package;
use Route;
use Whoops\Exception\ErrorException;
use BlockType;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{
    protected $pkgHandle = 'community_store_attribute_link_list';
    protected $appVersionRequired = '5.7.2';
    protected $pkgVersion = '0.9.1';

    public function getPackageDescription()
    {
        return t("Attribute Link List for Community Store");
    }

    public function getPackageName()
    {
        return t("Attribute Link List");
    }

    public function install()
    {
        $installed = Package::getInstalledHandles();
        if(!(is_array($installed) && in_array('community_store',$installed)) ) {
            throw new ErrorException(t('This package requires that Community Store be installed'));
        } else {
            $pkg = parent::install();
            $blk = BlockType::getByHandle('community_attribute_link_list');
            if(!is_object($blk) ) {
                BlockType::installBlockType('community_attribute_link_list', $pkg);
            }
        }

    }
}
?>
