<!-- Color 1 -->
<div class="form-row">
    {!! Form::label('color_1', 'Background') !!}
    
    <div class="form-row-body">
        {!! Form::input('color', 'color_1', null, ['class' => 'input-text']) !!}

        <?php if ($errors->first('title')) { ?>
            <p><?php echo $errors->first('title') ?></p>
        <?php } ?>
    </div>
</div>

<?php if ($errors->first('color_1')) { ?>
    <p><?php echo $errors->first('color_1') ?></p>
<?php } ?>

<!-- Color 2 -->
<div class="form-row">
    {!! Form::label('color_2', 'Primary') !!}
    
    <div class="form-row-body">
        {!! Form::input('color', 'color_2', null, ['class' => 'input-text']) !!}

        <?php if ($errors->first('title')) { ?>
            <p><?php echo $errors->first('title') ?></p>
        <?php } ?>
    </div>
</div>

<?php if ($errors->first('color_2')) { ?>
    <p><?php echo $errors->first('color_2') ?></p>
<?php } ?>

<!-- Color 3 -->
<div class="form-row">
    {!! Form::label('color_3', 'Secondary') !!}
    
    <div class="form-row-body">
        {!! Form::input('color', 'color_3', null, ['class' => 'input-text']) !!}

        <?php if ($errors->first('title')) { ?>
            <p><?php echo $errors->first('title') ?></p>
        <?php } ?>
    </div>
</div>

<?php if ($errors->first('color_3')) { ?>
    <p><?php echo $errors->first('color_3') ?></p>
<?php } ?>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
    </div>
</div>
