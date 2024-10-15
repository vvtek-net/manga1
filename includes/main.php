<?php
include('config/db_connection.php');

// Truyện Mới Cập Nhật - Lấy 10 truyện mới nhất
$query = "SELECT * FROM manga ORDER BY update_at DESC LIMIT 10";
$stmt = $conn->prepare($query);
$stmt->execute();
$manga_result = $stmt->get_result();

?>

<main>
    <div class="container-fluid">
        <div class="row">
            <!-- Menu -->

            <div class="cookie-consent-banner" id="cookie-consent-banner">
                <div class="cookie-consent-container">
                    <p>
                        Trang web này sử dụng cookie để đảm bảo bạn có được trải nghiệm tốt nhất trên trang web của chúng tôi.
                    </p>
                    <button class="btn btn-primary" id="accept-cookie">
                        Chấp nhận
                    </button>
                </div>
            </div>
            <!-- Nội dung chính -->
            <!DOCTYPE html>
            <html lang="vi">

            <head>
                <meta charset="utf-8" />
                <meta content="width=device-width, initial-scale=1.0" name="viewport" />
                <title>
                    Phieu vu
                </title>
            </head>
            <img alt="Background Image" class="top-bg-op-box" src="assets/image/banner.jpg" /> <!-- Banner -->
            <main>
                <div class="container">
                    <div class="main-content">
                        <div class="column-80">
                            <div class="fsdfs433">
                                <h3 class="thehh">
                                    TRUYỆN MỚI CẬP NHẬT
                                </h3>
                                <a href="filter.php">
                                    <i class="fa-solid fa-angles-right">
                                    </i>
                                </a>
                            </div>
                            <div class="recommended-stories">
                                <div class="story-row">
                                    <?php while ($row = $manga_result->fetch_assoc()) { ?>
                                        <div class="story-item">
                                            <div class="story-thumbnail">
                                                <div class="image-container">
                                                    <img alt="<?php echo $row['manga_name']; ?>" src="<?php echo 'assets/image/'.$row['imgurl']; ?>" />
                                                    <div class="read-count">
                                                        <i class="fa-solid fa-eye"></i>
                                                        <?php echo $row['view_number']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="story-details">
                                                <a class="tieude" href="story.php?manga_id=<?php echo $row['manga_id']; ?>" >
                                                    <?php echo $row['manga_name']; ?>
                                                </a>
                                                <p class="tomtat_v1">
                                                <?php echo substr($row['description'], 0, 200); ?>

                                                </p>
                                                <div class="jjskks11">
                                                    <p class="tacgia321">
                                                        <i class="fa-solid fa-user-pen"></i>
                                                        <?php echo $row['author']; ?>
                                                    </p>
                                                    <a class="theloai321" href="indexeb65.html?quanly=truyen&amp;category[]=T%c3%acnh%20c%e1%ba%a3m">
                                                        <?php
                                                        $query_type = "SELECT * FROM manga_type WHERE type_id = ?";
                                                        $stmt_type = $conn->prepare($query_type);
                                                        $stmt_type->bind_param('i', $row['type_id']);
                                                        $stmt_type->execute();
                                                        $result_type = $stmt_type->get_result();

                                                        if ($result_type->num_rows > 0) {
                                                            $manga_result_type = $result_type->fetch_assoc();
                                                            echo $manga_result_type['type_name'];
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Chương Mới Cập Nhật -->
                            <?php
                            $query = "SELECT c.chapter_name, c.update_at, c.manga_id, c.chapter_id, m.manga_name, m.author, mt.type_name 
                    FROM chapter c 
                    JOIN manga m ON c.manga_id = m.manga_id 
                    JOIN manga_type mt ON m.type_id = mt.type_id 
                    ORDER BY c.update_at DESC LIMIT 10";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $chapter_result = $stmt->get_result();
                            ?>
                            


                            <style>
                                .rank-number {
                                    font-weight: bold;
                                    margin-right: 10px;
                                }

                                .weekly-item,
                                .completed-item {
                                    display: flex;
                                    align-items: center;
                                    padding: 10px 0;
                                    border-bottom: 1px dotted #ccc;
                                }

                                .weekly-item a,
                                .completed-item a {
                                    margin-left: 10px;
                                    text-decoration: none;
                                    color: #333;
                                }

                                .weekly-list,
                                .completed-list {
                                    background: #f9f9f9;
                                    padding: 20px;
                                    border-radius: 8px;
                                }

                                .column {
                                    margin-bottom: 20px;
                                }

                                .column h3 {
                                    font-size: 1.5em;
                                    margin-bottom: 10px;
                                }

                                .read-counts,
                                .rank-number {
                                    font-size: 1em;
                                }
                            </style>

                            <!-- Top Đề Cử - Lấy 10 truyện được đề cử nhiều nhất -->
                            <?php
                            $rank = 1;

                            // Truy vấn kết hợp hai bảng manga và manga_nomination để lấy 10 truyện có số lượng đề cử nhiều nhất
                            $query = "SELECT manga.manga_id, manga.manga_name, manga.author, manga.imgurl, manga.view_number, COUNT(manga_nomination.nomination_id) as nomination_count
                                        FROM manga 
                                        JOIN manga_nomination ON manga.manga_id = manga_nomination.manga_id
                                        GROUP BY manga.manga_id
                                        ORDER BY nomination_count DESC
                                        LIMIT 10";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $nomination_result = $stmt->get_result();
                            ?>
                            <div class="column">
                                <h3 class="theh">TOP ĐỀ CỬ</h3>
                                <div class="weekly-list">
                                    <?php while ($nomination_row = $nomination_result->fetch_assoc()) { ?>
                                        <div class="weekly-item" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #ddd;">

                                            <!-- Số thứ tự và ảnh ở bên trái -->
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <span class="rank-number" style="font-weight: bold; font-size: 16px;"><?php echo $rank; ?></span>
                                                <div class="image-container" style="display: flex; align-items: center;">
                                                    <img alt="<?php echo $nomination_row['manga_name']; ?>" src="<?php echo 'assets/image/'.$nomination_row['imgurl']; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;" />
                                                    <div class="read-count" style="font-size: 12px; text-align: center;">
                                                        <i class="fa-solid fa-eye"></i> <?php echo $nomination_row['view_number']; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tên truyện ở giữa và được căn giữa theo chiều ngang -->
                                            <div style="flex-grow: 1; display: flex; justify-content: center;">
                                                <a class="tieudetruyen" href="story.php?manga_id=<?php echo $nomination_row['manga_id']; ?>" style="text-decoration: none; color: inherit;">
                                                    <p style="margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $nomination_row['manga_name']; ?></p>
                                                </a>
                                            </div>

                                            <!-- Tên tác giả ở bên phải -->
                                            <div class="tenuser" style="min-width: 80px; text-align: right; font-size: 14px;">
                                                <i class="fas fa-user-edit"></i>
                                                <span style="margin-left: 5px;"><?php echo $nomination_row['author']; ?></span>
                                            </div>
                                        </div>
                                    <?php $rank++;
                                    } ?>
                                </div>
                            </div>


                            <!-- Top Lượt Xem - Lấy 10 truyện có lượt xem nhiều nhất -->
                            <?php
                            $rank = 1;
                            $query = "SELECT * FROM manga ORDER BY view_number DESC LIMIT 10";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $view_result = $stmt->get_result();
                            ?>
                            <div class="column">
                                <h3 class="theh">TOP LƯỢT ĐỌC</h3>
                                <div class="weekly-list">
                                    <?php while ($view_row = $view_result->fetch_assoc()) { ?>
                                        <div class="weekly-item" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #ddd;">

                                            <!-- Số thứ tự và ảnh ở bên trái -->
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <span class="rank-number" style="font-weight: bold; font-size: 16px;"><?php echo $rank; ?></span>
                                                <div class="image-container" style="display: flex; align-items: center;">
                                                    <img alt="<?php echo $view_row['manga_name']; ?>" src="<?php echo 'assets/image/'.$view_row['imgurl']; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;" />

                                                </div>
                                            </div>

                                            <!-- Tên truyện ở giữa và được căn giữa theo chiều ngang -->
                                            <div style="flex-grow: 1; display: flex; justify-content: center;">
                                                <a class="tieudetruyen" href="story.php?manga_id=<?php echo $view_row['manga_id']; ?>" style="text-decoration: none; color: inherit;">
                                                    <p style="margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $view_row['manga_name']; ?></p>
                                                </a>
                                            </div>

                                            <!-- Tên tác giả ở bên phải -->
                                            <div class="tenuser" style="min-width: 80px; text-align: right; font-size: 14px;">
                                                <i class="fas fa-user-edit"></i>
                                                <span style="margin-left: 5px;"><?php echo $view_row['view_number']; ?></span>
                                            </div>
                                        </div>
                                    <?php $rank++;
                                    } ?>
                                </div>
                            </div>

                            <!-- Truyện Hoàn Thành - Lấy 10 truyện đã hoàn thành -->
                            <?php
                            $rank = 1;
                            $query = "SELECT * FROM manga_completed JOIN manga ON manga_completed.manga_id = manga.manga_id ORDER BY manga_completed.update_at DESC LIMIT 10";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $completed_result = $stmt->get_result();
                            ?>
                            <div class="column">
                                <h3 class="theh">TRUYỆN HOÀN THÀNH</h3>
                                <div class="weekly-list">
                                    <?php while ($completed_row = $completed_result->fetch_assoc()) { ?>
                                        <div class="weekly-item" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #ddd;">

                                            <!-- Số thứ tự và ảnh ở bên trái -->
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <span class="rank-number" style="font-weight: bold; font-size: 16px;"><?php echo $rank; ?></span>
                                                <div class="image-container" style="display: flex; align-items: center;">
                                                    <img alt="<?php echo $completed_row['manga_name']; ?>" src="<?php echo 'assets/image/'.$completed_row['imgurl']; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;" />
                                                    <div class="read-count" style="font-size: 12px; text-align: center;">
                                                        <i class="fa-solid fa-eye"></i> <?php echo $completed_row['view_number']; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tên truyện ở giữa và được căn giữa theo chiều ngang -->
                                            <div style="flex-grow: 1; display: flex; justify-content: center;">
                                                <a class="tieudetruyen" href="story.php?manga_id=<?php echo $completed_row['manga_id']; ?>" style="text-decoration: none; color: inherit;">
                                                    <p style="margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $completed_row['manga_name']; ?></p>
                                                </a>
                                            </div>

                                            <!-- Tên tác giả ở bên phải -->
                                            <div class="tenuser" style="min-width: 80px; text-align: right; font-size: 14px;">
                                                <i class="fas fa-user-edit"></i>
                                                <span style="margin-left: 5px;"><?php echo $completed_row['author']; ?></span>
                                            </div>
                                        </div>
                                    <?php $rank++;
                                    } ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </main>

            </html>
        </div>
    </div>
</main>
