<?php
namespace Concrete\Package\CommunityStoreAttributeLinkList\Block\CommunityAttributeLinkList;

use Concrete\Core\Block\BlockController;
use Core;
use Config;
use Page;
use Database;
use Concrete\Package\CommunityStore\Src\CommunityStore\Product\Product as StoreProduct;
use Concrete\Package\CommunityStore\Src\CommunityStore\Product\ProductList as StoreProductList;
use Concrete\Package\CommunityStore\Src\CommunityStore\Group\GroupList as StoreGroupList;
use Concrete\Package\CommunityStore\Src\Attribute\Key\StoreProductKey;
use Concrete\Package\CommunityStore\Src\CommunityStore\Group\Group as StoreGroup;
class Controller extends BlockController
{
    protected $btTable = 'btCommunityStoreAttributeLinkList';
    protected $btInterfaceWidth = "500";
    protected $btWrapperClass = 'ccm-ui';
    protected $btInterfaceHeight = "200";
    protected $btDefaultSet = 'community_store';

    public function getBlockTypeDescription()
    {
        return t("A list of Attribute Values that links to a filtered product list for Community Store");
    }

    public function getBlockTypeName()
    {
        return t("Attribute List");
    }
    public function add()
    {
        $this->requireAsset('css', 'select2');
        $this->requireAsset('javascript', 'select2');
        $this->set("attributeList", $this->getAttributeKeyValueList());
        $this->set('attributefilters',$this->getAttributeFilters());
    }
    public function edit()
    {
        $this->requireAsset('css', 'select2');
        $this->requireAsset('javascript', 'select2');
        $this->set("attributeList", $this->getAttributeKeyValueList());
        $this->set('attributefilters',$this->getAttributeFilters());

    }


    public function view()
    {
        //prepare attribute list in alphabetical order that links to http://artgalleriesdirect.mary.dsuk11.co.uk/artist?attribute-filter[43][]=237
        // echo "akid: " . $this->akID;
        $attributeList = $this->getAttributeKeyValueList(array($this->akID));
        $this->set("attributeList", $attributeList);
    }
    public function registerViewAssets($outputContent = '')
    {
        $this->requireAsset('javascript', 'jquery');
        $js = \Concrete\Package\CommunityStore\Controller::returnHeaderJS();
        $this->addFooterItem($js);
        $this->requireAsset('javascript', 'community-store');
        $this->requireAsset('css', 'community-store');
        $this->requireAsset('jquery/ui');
    }
    public function save($args)
    {
        parent::save($args);
    }



    public function getAttributeKeyValueList($akIDs = array()){
      $list = StoreProductKey::getAttributeKeyValueList($akIDs);
      return $list;
    }

    public function getAttributeFilters()
    {
        $db = \Database::connection();
        $result = $db->query("SELECT akID FROM btCommunityStoreProductListAttributes where bID = ?", array($this->bID));

        $list = array();

        if ($result) {
            foreach ($result as $ak) {
                $list[] = $ak['akID'];
            }
        }
        return $list;
    }

}
