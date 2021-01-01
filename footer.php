<footer>
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-1 d-flex justify-content-center">
                <div class="pt-3 d-flex align-items-center justify-content-center" id="bug-container">
                    <i class="fas fa-bug fs-1" id="bug"></i>
                </div>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="form-check form-switch pt-4 d-print-none">
                    <!--          Depending on skin mode, checkbox position gets set. Via reload_cookies.php          -->
                    <input class="form-check-input" type="checkbox" id="colorSwitchCheck" onclick="setSkinMode()" <?php echo $checkbox_value ?>>
                    <label class="form-check-label" for="colorSwitchCheck">Dark mode</label>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
</script>
</body>
</html>
