--a
SELECT baiviet.ten_bhat 
FROM baiviet,theloai 
WHERE baiviet.ma_tloai = theloai.ma_tloai 
AND theloai.ten_tloai = "Nhạc trữ tình";
--b
SELECT baiviet.tieude 
FROM baiviet,tacgia 
WHERE baiviet.ma_tgia = tacgia.ma_tgia 
AND tacgia.ten_tgia = "Nhacvietplus";
--c
SELECT t.ten_tloai
FROM theloai t
LEFT JOIN baiviet b ON t.ma_tloai = b.ma_tloai
WHERE b.ma_bviet IS NULL;
--d
SELECT 
    b.ma_bviet AS `Mã bài viết`,
    b.tieude AS `Tên bài viết`,
    b.ten_bhat AS `Tên bài hát`,
    t.ten_tgia AS `Tên tác giả`,
    tl.ten_tloai AS `Tên thể loại`,
    b.ngayviet AS `Ngày viết`
FROM 
    baiviet b
JOIN 
    tacgia t ON b.ma_tgia = t.ma_tgia
JOIN 
    theloai tl ON b.ma_tloai = tl.ma_tloai;
--e
SELECT 
    tl.ten_tloai AS `Tên thể loại`,
    COUNT(b.ma_bviet) AS `Số bài viết`
FROM 
    theloai tl
LEFT JOIN 
    baiviet b ON tl.ma_tloai = b.ma_tloai
GROUP BY 
    tl.ma_tloai, tl.ten_tloai
ORDER BY 
    `Số bài viết` DESC
LIMIT 1;
--f
SELECT 
    t.ten_tgia AS `Tên tác giả`,
    COUNT(b.ma_bviet) AS `Số bài viết`
FROM 
    tacgia t
LEFT JOIN 
    baiviet b ON t.ma_tgia = b.ma_tgia
GROUP BY 
    t.ma_tgia, t.ten_tgia
ORDER BY 
    `Số bài viết` DESC
LIMIT 2;
--g
SELECT 
    ma_bviet AS `Mã bài viết`,
    tieude AS `Tiêu đề bài viết`,
    ten_bhat AS `Tên bài hát`,
    tomtat AS `Tóm tắt`,
    noidung AS `Nội dung`,
    ngayviet AS `Ngày viết`
FROM 
    baiviet
WHERE 
    ten_bhat LIKE '%yêu%' 
    OR ten_bhat LIKE '%thương%'
    OR ten_bhat LIKE '%anh%'
    OR ten_bhat LIKE '%em%';
--h
SELECT 
    ma_bviet AS `Mã bài viết`,
    tieude AS `Tiêu đề bài viết`,
    ten_bhat AS `Tên bài hát`,
    tomtat AS `Tóm tắt`,
    noidung AS `Nội dung`,
    ngayviet AS `Ngày viết`
FROM 
    baiviet
WHERE 
    tieude LIKE '%yêu%' 
    OR tieude LIKE '%thương%'
    OR tieude LIKE '%anh%'
    OR tieude LIKE '%em%'
    OR ten_bhat LIKE '%yêu%' 
    OR ten_bhat LIKE '%thương%'
    OR ten_bhat LIKE '%anh%'
    OR ten_bhat LIKE '%em%';
--i
CREATE VIEW vw_Music AS
SELECT 
    b.ma_bviet AS `Mã bài viết`,
    b.tieude AS `Tiêu đề bài viết`,
    b.ten_bhat AS `Tên bài hát`,
    t.ten_tgia AS `Tên tác giả`,
    tl.ten_tloai AS `Tên thể loại`,
    b.ngayviet AS `Ngày viết`
FROM 
    baiviet b
JOIN 
    tacgia t ON b.ma_tgia = t.ma_tgia
JOIN 
    theloai tl ON b.ma_tloai = tl.ma_tloai;

SELECT * FROM vw_Music
--j
DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN p_ten_tloai VARCHAR(50))
BEGIN
    DECLARE v_ma_tloai INT;

    -- Kiểm tra xem thể loại có tồn tại không
    SELECT ma_tloai INTO v_ma_tloai
    FROM theloai
    WHERE ten_tloai = p_ten_tloai;

    IF v_ma_tloai IS NULL THEN
        -- Nếu thể loại không tồn tại, hiển thị thông báo lỗi
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Thể loại không tồn tại.';
    ELSE
        -- Nếu thể loại tồn tại, truy vấn danh sách bài viết của thể loại đó
        SELECT 
            b.ma_bviet AS `Mã bài viết`,
            b.tieude AS `Tiêu đề bài viết`,
            b.ten_bhat AS `Tên bài hát`,
            b.tomtat AS `Tóm tắt`,
            b.noidung AS `Nội dung`,
            b.ngayviet AS `Ngày viết`
        FROM 
            baiviet b
        WHERE 
            b.ma_tloai = v_ma_tloai;
    END IF;
END //

DELIMITER ;
EXEC sp_DSBaiViet;
--k
DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    -- Cập nhật số lượng bài viết cho thể loại mới
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END //

CREATE TRIGGER tg_CapNhatTheLoai_Update
AFTER UPDATE ON baiviet
FOR EACH ROW
BEGIN
    -- Nếu thể loại bài viết bị thay đổi
    IF OLD.ma_tloai <> NEW.ma_tloai THEN
        -- Giảm số lượng bài viết của thể loại cũ
        UPDATE theloai
        SET SLBaiViet = SLBaiViet - 1
        WHERE ma_tloai = OLD.ma_tloai;

        -- Tăng số lượng bài viết của thể loại mới
        UPDATE theloai
        SET SLBaiViet = SLBaiViet + 1
        WHERE ma_tloai = NEW.ma_tloai;
    END IF;
END //

CREATE TRIGGER tg_CapNhatTheLoai_Delete
AFTER DELETE ON baiviet
FOR EACH ROW
BEGIN
    -- Giảm số lượng bài viết cho thể loại bài viết bị xóa
    UPDATE theloai
    SET SLBaiViet = SLBaiViet - 1
    WHERE ma_tloai = OLD.ma_tloai;
END //

DELIMITER ;

--l
