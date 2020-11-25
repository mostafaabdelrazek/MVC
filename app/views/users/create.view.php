<form autocomplete="off" class="appForm clearfix" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class = "input_wrapper n40 border">
            <label <?=$this->labelFloat('Username')?>><?= $text_label_Username ?></label>
            <input required type="text" name="Username" value="<?= $this->showValue('Username')?>">
        </div>
        <div class="input_wrapper n30 border padding">
            <label><?= $text_label_Password ?></label>
            <input required type="password" name="Password" >
        </div>
        <div class="input_wrapper n30 padding">
            <label><?= $text_label_CPassword ?></label>
            <input required type="password" name="CPassword" >
        </div>
        <div class="input_wrapper n30 border padding">
            <label <?=$this->labelFloat('Email')?>><?= $text_label_Email ?></label>
            <input required type="" name="Email"  maxlength="40" value="<?= $this->showValue('Email')?>">
        </div>
        <div class="input_wrapper n30 border padding">
            <label <?=$this->labelFloat('CEmail')?>><?= $text_label_CEmail ?></label>
            <input required type="email" name="CEmail"  maxlength="40"  value="<?= $this->showValue('CEmail')?>">
        </div>
        <div class="input_wrapper n20 border padding">
            <label <?=$this->labelFloat('PhoneNumber')?>><?= $text_label_PhoneNumber ?></label>
            <input required type="text" name="PhoneNumber" value="<?= $this->showValue('PhoneNumber')?>">
        </div>
        <div class='input_wrapper_other n20 padding select'>
            <select required name="GroupId" >
            <option value=""><?=$text_user_GroupId?></option>
            <?php if(false != $groups): foreach($groups as $group):?>
            <option value="<?=$group->GroupId?>"><?=$group->GroupName?></option>
            <?php endforeach; endif;?>
            </select>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>