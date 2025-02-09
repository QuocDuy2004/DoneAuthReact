console.log("info: v1.0.1");
window.$getResponseMessage = function (n) {
    return n.response && n.response.data
        ? n.response.data.message
        : n.message || "Unknown error";
};
window.$getRequestMessage = function (n) {
    return n.message || "Error in request";
};
window.$getStatusMessage = function (n) {
    return n.responseJSON ? n.responseJSON.message : n.statusText;
};
window.$getErrorMessage = function (n) {
    return n.message || n.stack;
};
window.$catchMessage = function (n) {
    let e = "System error occurred";
    return (
        (e = n.isAxiosError
            ? n.response
                ? $getResponseMessage(n)
                : n.request
                ? $getRequestMessage(n)
                : e
            : n.status
            ? $getStatusMessage(n)
            : $getErrorMessage(n)),
        console.log(n.response || n.request || n),
        e
    );
};
window.$formatNumber = function (n) {
    return new Intl.NumberFormat("en-US").format(n);
};
window.$formatDateTime = function (n, e = "YYYY-MM-DD HH:mm:ss") {
    return moment(n).format(e);
};
window.$formatStatus = function (n) {
    switch (n) {
        case "Running":
            return '<span class="badge bg-primary">Đang chạy</span>';
        case "Pending":
            return '<span class="badge bg-warning">Đang chờ</span>';
        case "Preparing":
            return '<span class="badge bg-info">Đang chuẩn bị</span>';
        case "Canceled":
            return '<span class="badge bg-danger">Đã hủy</span>';
        case "Completed":
            return '<span class="badge bg-success">Chạy xong</span>';
        case "Refund":
            return '<span class="badge bg-danger">Hoàn tiền</span>';
        case "WaitingForRefund":
            return '<span class="badge bg-secondary">Đang hủy</span>';
        case "Holding":
            return '<span class="badge bg-warning">Đang giữ</span>';
        case "Paused":
            return '<span class="badge bg-danger">Tạm dừng</span>';
        case "Expired":
            return '<span class="badge bg-danger">Hết hạn</span>';
        case "Active":
            return '<span class="badge bg-success">Hoạt động</span>';
        case "Warranty":
            return '<span class="badge bg-info">Bảo hành</span>';
        default:
            return `<span class="badge bg-secondary">${n}</span>`;
    }
};
window.$setLoading = function (n) {
    $(n).attr("disabled", !0).addClass("process");
};
window.$removeLoading = function (n) {
    $(n).attr("disabled", !1).removeClass("process");
};
window.$formatDate = function (n, e = "YYYY-MM-DD HH:mm:ss") {
    return moment(n).format(e);
};
window.$isURL = function (n) {
    let e =
        /(http|https):\/\/(\w+:?\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    return new RegExp(e).test(n);
};
window.$truncate = function (n, e = 100, s = "...") {
    return n.length > e ? n.substring(0, e - s.length) + s : n;
};
window.$swal = function (n, e, s = {}) {
    return Swal.fire({
        icon: n === "success" ? "success" : "error",
        title: n === "success" ? "Thành công" : "Thất bại",
        text: e,
        ...s,
    });
};
window.$showLoading = function (n = null) {
    Swal.fire({
        icon: "info",
        title: "Đang xử lý!",
        html: "Không được tắt trang này, vui lòng đợi trong giây lát!",
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        didOpen: () => {
            Swal.showLoading();
        },
        willClose: () => {},
    });
};

window.$showMsg = function (n, e, s = {}) {
    return Swal.mixin({
        toast: !0,
        position: "top",
        showConfirmButton: !1,
        timer: 2e3,
        timerProgressBar: !0,
    }).fire({
        icon: n === "success" ? "success" : "error",
        title: n === "success" ? "Thành công" : "Thất bại",
        text: e,
        ...s,
    });
};
window.$hideLoading = function () {
    Swal.close();
};
window.$base64_decode = function (n) {
    return decodeURIComponent(
        atob(n)
            .split("")
            .map(function (e) {
                return "%" + ("00" + e.charCodeAt(0).toString(16)).slice(-2);
            })
            .join("")
    );
};
window.$getCountryName = function (n) {
    return n
        ? new Intl.DisplayNames(["en"], { type: "region" }).of(
              n == null ? void 0 : n.toUpperCase()
          )
        : "-";
};
window.$formDataToPayload = function (n) {
    const e = {};
    for (let [s, a] of n.entries()) e[s] = a;
    return e;
};
window.$ucfirst = function (n) {
    return n.charAt(0).toUpperCase() + n.slice(1);
};
window.addEventListener("online", function (n) {
    console.log("online"), $swal("success", "Đã kết nối mạng");
});
window.addEventListener("offline", function (n) {
    console.log("offline"), $swal("error", "Mất kết nội mạng");
});
let t = new ClipboardJS(".copy");
t.on("success", function (n) {
    toastr.success("Copied : " + n.text);
});
t.on("error", function (n) {
    toastr.error("Failed to copy");
});
window.$userLevelName = function (n) {
    return n.charAt(0).toUpperCase() + n.slice(1);
};
window.$logout = async function () {
    try {
        const n = await axios.post("/logout");
    } finally {
        window.location.href = "/login";
    }
};
