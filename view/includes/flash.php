<div class="row"> 
    <?php $_SESSION['error'] = isset($_SESSION['error'])?$_SESSION['error']:""; ?>
    <?php $_SESSION['msg'] = isset($_SESSION['msg'])?$_SESSION['msg']:""; ?>
    <?php if ($_SESSION['error'] != "") { ?>
        <div class="col-md-6">
            <div class="alert alert-danger">
                <strong>Error :</strong>
                <?php echo htmlentities($_SESSION['error']); ?>
                <?php unset($_SESSION['error']) ?>
            </div>
        </div>
    <?php } ?>
    <?php if ($_SESSION['msg'] != "") { ?>
        <div class="col-md-6">
            <div class="alert alert-success">
                <strong>Success :</strong>
                <?php echo htmlentities($_SESSION['msg']); ?>
                <?php unset($_SESSION['msg']) ?>
            </div>
        </div>
    <?php } ?>
</div>