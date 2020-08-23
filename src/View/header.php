<?php require_once "../Controller/DataPrint_controller.php"; ?>

<header class="header">
    <span class="header__burger"></span>
    <a class="header__title" href="main_page.php?new&page=0">myBlogProject</a>
    <nav class="header__menu">
        <div class="header__menu_home">
            <button class="header__dropdown">Меню</button>
            <div class="header__menu_list">
                <a href="main_page.php?new&page=0">Сначала новые</a>
                <a href="main_page.php?views&page=0">Самые просматриваемые</a>
                <a href="main_page.php?comments&page=0">Наиболее обсуждаемые</a>
            </div>
        </div>
        <div class="header__menu_categories">
            <button class="header__dropdown">Категории</button>
            <div class="header__menu_list">
                <?php
                foreach ($categories as $category) {
                    echo '<a href="main_page.php?category-id='.$category['id'].'&page=0">'.$category['title'].'</a>';
                }
                ?>
            </div>
        </div>
    </nav>
    <form class="header__form">
        <input type="text" placeholder="Поиск по заголовку" class="header__search" name="title">
        <svg class="icon-search" onclick="openSearchBar()">
            <use xlink:href="../img/svg/sprite.svg#search"></use>
        </svg>
    </form>
    <div class="header__profile_submenu">
        <div class="header__profile">
            <img src="<?php echo $_SESSION['user']['avatar'];?>" alt="аватарка" class="header__profile_avatar">
            <span class="header__profile_nickname">
                     <?php echo $_SESSION['user']['nickname'];?>
                </span>
        </div>
        <div class="header__profile_submenu_options">
            <a href="profile.php">Профиль</a>
            <a href="create_article.php">Написать статью</a>
            <a href="profile_settings.php">Настройки</a>
            <a href="../Controller/log_out_controller.php">Выход</a>
        </div>
    </div>
</header>

<script src="../js/search.js"></script>

