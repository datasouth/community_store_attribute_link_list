<?php defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Package\CommunityStore\Src\Attribute\Value\StoreProductValue as StoreProductValue; ?>

<div class="row">

    <div class="col-xs-12">

        <fieldset>

            <?php
            if(!empty($attributeList)){
              foreach ($attributeList as $key => $val) {
                  $attributes[$key] = $val['name'];
              }
            }
            ?>
            <?php if (!empty($attributes)) { ?>
                <?= $form->label('attributes', t('Select Product Attributes')); ?>
                <div class="form-group">
                    <div class="ccm-search-field-content ccm-search-field-content-select2">
                        <select multiple="multiple" name="akID" id="attributes-select"
                                class="existing-select2 select2-select" style="width: 100%" placeholder="<?= t('Type an attribute') ?>">
                            <?php foreach ($attributes as $akey => $alabel) { ?>
                                <option
                                    value="<?= $akey; ?>" <?= (in_array($akey, $attributefilters) ? 'selected="selected"' : ''); ?>><?= $alabel; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <style>
                .select2-container {
                  z-index: 2000;
                }
                </style>

            <?php } ?>

            <div class="form-group" id="pageselector">
                <div
                    class="form-group">
                    <?php
                    $ps = Core::make('helper/form/page_selector');
                    echo $ps->selectPage('attributeCID', ($attributeCID > 0 ? $attributeCID : false)); ?>
                </div>
            </div>

        </fieldset>


    </div>
</div>


<script>
    $(document).ready(function () {
        $('#attributes-select').select2({
          maximumSelectionSize: 1
        });
    });
</script>
