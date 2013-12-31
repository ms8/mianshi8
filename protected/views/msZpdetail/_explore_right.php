<div class="right5">
    <div class="right6">职位标签</div>
    <div class="right7">
        <div class="right71">
            <?php $tagList = MsDictionary::model()->findAll(array("condition"=>"type = 'zp_tag'")); ?>
            <?php foreach($tagList as $v){ ?>
                <div class="right_zp">
                    <a <?php if($tagSelected != null && $tagSelected == $v->code) {?>
                        class="a_selected"
                        <?php }?>
                        href="<?php echo $this->createUrl('/mszpdetail/listbytag',
                        array('tagCode'=>$v->code,'zpId'=>$this->zph->id)); ?>"><?php echo $v->name; ?></a>
                </div>
            <?php } ?>
        </div>
        <div class="right2">
        </div>
    </div>
</div>