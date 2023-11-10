<div class="row"> 
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
    <?php if ($_SESSION['updatemsg'] != "") { ?>
        <div class="col-md-6">
            <div class="alert alert-success">
                <strong>Success :</strong>
                <?php echo htmlentities($_SESSION['updatemsg']); ?>
                <?php unset($_SESSION['updatemsg']) ?>
            </div>
        </div>
    <?php } ?>
    <?php if ($_SESSION['delmsg'] != "") { ?>
        <div class="col-md-6">
            <div class="alert alert-success">
                <strong>Success :</strong>
                <?php echo htmlentities($_SESSION['delmsg']); ?>
                <?php unset($_SESSION['delmsg']) ?>
            </div>
        </div>
    <?php } ?>
</div>