<?php 
class x6plugindetailDisplay {
    # ================================================================
    # 
    # Plugin main function, usually generates first version
    #  that goes to browser
    #
    # ================================================================
    function &main(&$area1,$dd) {
        $table_id = $dd['table_id'];

        $area1->addClass('box2');
        $area1->hp['x6plugin'] = 'detailDisplay';
        $area1->hp['x6table']  = $table_id;
        $area1->hp['id'] = 'ddisp_'.$table_id;
        
        # Now for the display
        # Put some buttons on users
        $area1->addButtonBar($table_id);
                
        # generate a detail pane of inputs and assign
        # the standard keyup to all of them.
        #
        # Note: tabLoop is a requirement for x4 that is easier
        # to just define and pass in than it is to try to make
        # it go away.  
        $tabLoop = array();
        $options = array(
            'onkeyup'=>'x6inputs.keyUp(event,this)'
            ,'onkeydown'=>'x6inputs.keyDown(event,this)'
            ,'onfocus'=>'x6inputs.focus(this)'
            ,'onblur'=>'x6inputs.blur(this)'
            ,'attributes'=>array(
                'xClassRow'=>1
                ,'disabled'=>true
            )
            ,'classes'=>array('readOnly')
            ,'tabIndex'=>true
            
        );
        $projection = projection($dd,'',$tabLoop,$options);
        //foreach($projection->inputs as $idx=>$input) {
            //$projection->inputs[$idx]->addClass('readOnly');
            //$projection->inputs[$idx]->tabIndex();
        //}
        
        $parea = $area1->h('div');
        $parea->addClass('box1');
        $parea->addChild($projection);
        $parea->hp['style'] = 'height: 545px; clear: both;';
        
        $sb = $area1->h('div','status message here');
        $sb->addClass('statusBar');
        
        $disables=<<<JS
            x6events.fireEvent('disable_duplicate');
            x6events.fireEvent('disable_save');
            x6events.fireEvent('disable_abandon');
            x6events.fireEvent('disable_remove');
JS;
        jqDocReady($disables);

        return $area1;
    }
}
?>
