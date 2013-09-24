<div class="login">
    <div class="login-screen">
        <div class="login-icon">
            <img alt="Bienvenido a Bioritmos" src="<?php echo asset('images/bioritmo.png')?>">
            <h4>Welcome to <small>Bioritmos</small></h4>
        </div>

        <div class="login-form">
            <form action="<?php echo url('/bioritmo') ?>" method="post" ?>
            <div class="control-group">
                <input type="input" id="fechaN" name="fechaN" placeholder="¿Cuándo naciste?" value="" class="login-field">
            </div>
            <input type="submit"  class="btn btn-primary btn-large btn-block" value="Dime mi bioritmo">
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $( "#fechaN" ).datepicker();
    });
</script>