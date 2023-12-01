<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['access_count'])) {
                    echo "Your site access count:";
                    echo $_SESSION['access_count'];
                } ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                &copy;
                2023 NurseryPro
            </div>

        </div>
    </div>
</section>

<script src="public/js/jquery-3.7.1.js"></script>
<script src="public/js/bootstrap.js"></script>