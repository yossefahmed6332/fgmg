<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // تحديد مسار تخزين الصورة
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // التحقق من أن الملف هو صورة فعلية
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "الملف هو صورة - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "الملف ليس صورة.";
        $uploadOk = 0;
    }

    // تحقق من حجم الملف (مثلاً أقل من 5 ميغابايت)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "عذرًا، حجم الملف كبير جدًا.";
        $uploadOk = 0;
    }

    // السماح بأنواع معينة من الملفات فقط
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
    && $imageFileType != "gif" ) {
        echo "عذرًا، فقط ملفات JPG و JPEG و PNG و GIF مسموح بها.";
        $uploadOk = 0;
    }

    // التحقق إذا كان الرفع مسموحًا
    if ($uploadOk == 0) {
        echo "عذرًا، لم يتم رفع الملف.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "تم رفع الصورة ". basename($_FILES["image"]["name"]). " بنجاح.";
        } else {
            echo "عذرًا، حدث خطأ أثناء رفع الملف.";
        }
    }
}
?>
