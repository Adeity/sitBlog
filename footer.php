<footer>
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-1 d-flex justify-content-center">
                <div class="pt-3 d-flex align-items-center justify-content-center" id="bug-container">
                    <i class="fas fa-bug fs-1 <?php echo $bug_rotate_value ?>" id="bug"></i>
                </div>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="form-check form-switch pt-4 d-print-none">
                    <input class="form-check-input" type="checkbox" id="colorSwitchCheck" onclick="setColorMode()" <?php echo $checkbox_value ?>>
                    <label class="form-check-label" for="colorSwitchCheck" onclick="setColorMode()">Dark mode</label>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="js/main.js" type="application/javascript"></script>
</html>
