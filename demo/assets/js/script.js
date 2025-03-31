//nút xóa trong admin
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete");
    
    deleteButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            if (!confirm("Bạn có chắc chắn muốn xóa?")) {
                event.preventDefault(); 
            }
        });
    });
});

//nút mua trong user
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has("login_required")) {
        alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!");
        window.location.href = "login.php"; 
    }

    if (urlParams.has("cart_success")) {
        alert("Đã thêm vào giỏ hàng!");
        history.replaceState({}, document.title, window.location.pathname); 
    }
});

// User
document.addEventListener("DOMContentLoaded", function () {
    const editBtn = document.getElementById("editBtn");
    const closePopup = document.getElementById("closePopup");
    const editPopup = document.getElementById("editPopup");
    const updateForm = document.getElementById("updateForm");
    const updateStatus = document.getElementById("updateStatus");

    if (editBtn && closePopup && editPopup && updateForm) {
        editBtn.addEventListener("click", function () {
            editPopup.style.display = "block";
        });

        closePopup.addEventListener("click", function () {
            editPopup.style.display = "none";
        });

        updateForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(updateForm);

            fetch("update_user.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(response => {
                response = response.trim();
                if (response === "success") {
                    updateStatus.textContent = "Cập nhật thành công!";
                    updateStatus.style.color = "green";

                    setTimeout(() => location.reload(), 1000);

                    document.getElementById("display-username").textContent =
                        document.getElementById("username").value;
                    document.getElementById("display-email").textContent =
                        document.getElementById("email").value;

                    const avatarFile = document.getElementById("avatar").files[0];
                    if (avatarFile) {
                        document.getElementById("user-avatar").src = "image_user/" + avatarFile.name;
                    }
                } else {
                    updateStatus.textContent = response;
                    updateStatus.style.color = "red";
                }
            })
            .catch(() => {
                updateStatus.textContent = "Có lỗi xảy ra khi cập nhật thông tin.";
                updateStatus.style.color = "red";
            });
        });
    }
});

// wishlist
document.addEventListener("DOMContentLoaded", function () {
    const checkoutBtn = document.querySelector(".checkout-btn");
    const checkoutModal = document.getElementById("checkout-modal");
    const cancelBtn = document.querySelector(".cancel-checkout");

    if (checkoutBtn && checkoutModal) {
        checkoutBtn.addEventListener("click", function () {
            checkoutModal.style.display = "block";
        });
    }

    if (cancelBtn && checkoutModal) {
        cancelBtn.addEventListener("click", function () {
            checkoutModal.style.display = "none";
        });
    }
});







