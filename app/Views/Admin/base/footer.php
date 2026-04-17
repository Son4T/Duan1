<footer class="footer">
            <!-- Thêm nội dung footer ở đây nếu cần -->
        </footer>
    </main>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var menuItems = document.querySelectorAll(".menu-item");
        menuItems.forEach(function(item) {
            item.addEventListener("click", function() {
                var submenu = this.nextElementSibling;
                if (submenu.style.display === "block") {
                    submenu.style.display = "none";
                } else {
                    submenu.style.display = "block";
                }
            });
        });
    });
</script>
</body>
</html>
