<?php echo form_open('login/guarda_admin'); ?>
    <!--div>
        <span>
            <?php echo form_label('Nombre del Admin:', 'nombreAdmin'); ?>
        </span>
        <span>
            <?php echo form_input(array('id'=>'',
                                        'class'=>'',
                                        'name'=>'Registro[adminNombre]',
                                        'value'=>'')); ?>
        </span>
    </div-->
    <div>
        <span>
            <?php echo form_label('Nombre de Usuario: ', 'nombreUsurio'); ?>
        </span>
        <span>
            <?php echo form_input(array('id'=>'',
                                        'class'=>'',
                                        'name'=>'Registro[adminUsername]',
                                        'value'=>'')); ?>
        </span>
    </div>
    <div>
        <span>
            <?php echo form_label('Password: ', 'password'); ?>
        </span>
        <span>
            <?php echo form_password(array('id'=>'',
                                           'class'=>'',
                                           'name'=>'Registro[adminPassword]',
                                           'value'=>'')); ?>
        </span>
    </div>
    <!--div>
        <span>
            <?php echo form_label('Email: ', 'email'); ?>
        </span>
        <span>
            <?php echo form_input(array('id'=>'',
                                        'class'=>'',
                                        'name'=>'Registro[adminEmail]',
                                        'value'=>'')); ?>
        </span>
    </div-->
    <div>
        <?php echo form_submit(array('id'=>'',
                                     'class'=>'',
                                     'value'=>'Guardar')); ?>
    </div>
<?php echo form_close(); ?>
