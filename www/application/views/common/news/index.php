
<div id="navsec">
	<a href="http://feeds.feedburner.com/axespro" class="btn btn-warning rss" target="_blank">Подписаться через RSS</a>
	<h1>Новости</h1>
</div>

<div id="content" class="full-page">
<div class="vidivici">
        <?php $categories = Kohana::$config->load('default.categories'); ?>
        <?php if (!count($news)): ?>
        <h3>Пока новостей нет</h3>
        <?php else: ?>
            <?php foreach ($news as $new): ?>

                <div class="news-item">
                        <h1><a href="<?php echo URL::site("news/{$new->url}");?>"><?php echo $new->title;?></a></h1>

                        <p><?php echo $new->annotation; ?> </p>
						 <div class="entry-meta">
								 <span class="post-date"><i class="icon-time"></i><?php echo $new->date_format(); ?></span>
								 <?php if($new->category): ?>
                                <span class="post-tags"><i class="icon-flag"></i> <?php echo HTML::anchor(URL::site('news/categories/'.@$categories[$new->category]), @$categories[$new->category]);?></span>
                                <?php endif; ?>

                                <!-- <span class="post-comments"><i class="icon-comment"></i><a href="<?php echo URL::site("news/{$new->id}");?>#comments"><?php echo $new->comments->count_all();?></a>

                                </span> -->
								<a href="<?php echo URL::site("news/{$new->url}");?>" style="float:right;">Читать далее »</a>
                        </div>
                </div>

                <div class="clearfix"></div>

            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($pagination)): ?>
            <div id="page-nav">
                <?php echo $pagination;?>
            </div>
        <?php endif; ?>

        </div> <!-- end content -->
</div>
<div class="deusexmachina">
    <div class="hrclubdeus purple">
        <h5 style="color:#000!important;">Категории новостей</h5>
        <div class="clubinfo eventcatdeus">
            <a href="<?= Kohana::$base_url ?>news/categories/%D0%9C%D0%B5%D1%80%D0%BE%D0%BF%D1%80%D0%B8%D1%8F%D1%82%D0%B8%D1%8F">
                <h3>Мероприятия</h3>
                <em>Отчеты о семинарах и клубах</em>
            </a>
        </div>
        <div class="clearfix"></div>
        <div class="clubinfo publcatdeus">
            <a href="<?= Kohana::$base_url ?>news/categories/%D0%9F%D1%83%D0%B1%D0%BB%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D0%B8">
                <h3>Публикации</h3>
                <em>Интересные статьи из мира HR</em>
            </a>
        </div>
        <div class="clearfix"></div>
        <div class="clubinfo newcatdeus">
            <a href="<?= Kohana::$base_url ?>news/categories/%D0%90%D0%BD%D0%BE%D0%BD%D1%81%D1%8B">
                <h3>Анонсы</h3>
                <em>Релизы новинок</em>
            </a>
        </div>
        <div class="clearfix"></div>
        <div class="clubinfo projectcatdeus">
            <a href="<?= Kohana::$base_url ?>news/categories/%D0%9F%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D1%8B">
                <h3>Проекты</h3>
                <em>Завершенные и начатые проекты</em>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="sempermachina purple lastNews">
      <h5>Последняя новость</h5>
      <h4><a href="<?= Kohana::$base_url ?><?= $last_news['url']?>"><?= $last_news['title'] ?></a></h4>
                  <em><?= $last_news['annotation'] ?></em>
    </div>


    <!--<form action="#" method="post" id="newsForm" class="cmxform">
            <fieldset>
                <p>
                    <input type="text" id="bname" value="Поиск" class="required" name="cname" onblur="if(this.value=='Поиск')this.value='';" onfocus="if(this.value=='Поиск')this.value='';">
                </p>
            </fieldset>
        </form> -->
    <!-- <div class="hrnoline"></div>
        <center><a class="btn btn-large btn-success" href="<?= Kohana::$base_url ?>hrclub/2012/autunno/registration">Регистрация на Осенний HR Клуб</a></center>
        <div class="hrnoline"></div>
        <div class="latest news posts">
                <ul>
                    <?php $icons = Kohana::$config->load('default.categories_icons'); ?>
                    <?php $сoms = Kohana::$config->load('default.categories_comments'); ?>
                    <?php foreach (Kohana::$config->load('default.categories') as $key=>$value): ?>
                        <li>
                            <a href="<?php echo URL::site('news/categories/' . $value); ?>">
                                <div class="img"><img alt="<?php echo $value; ?>" src="<?php echo URL::base(); ?>assets/images/icons/<?php echo $icons[$key]; ?>"></div>
                                <div class="content">
                                    <h3><?php echo $value; ?></h3>
                                    <p><?php echo $сoms[$key]; ?></p>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
        </div>  end latest news posts -->
    <div class="sempermachina" style="overflow:auto;">
        <div class="post-tags-in">
            <?php $cnt=0 ; ?>
            <?php foreach (ORM::factory( 'tag')->find_all() as $tag): ?>
            <?php if ($cnt < 34): ?>
            <?php if ($tag->news->count_all()): ?>
            <?php echo HTML::anchor(URL::site( 'news/tags/'. $tag->title), $tag->title); ?>
            <?php $cnt++; ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="sempermachina tndmeru">
        <a href="http://tndme.ru" target="_blank">
            <h4 style="font-variant: small-caps;color:#FFF;font-size:22pt;font-weight:800;letter-spacing:10px;line-height:25pt;text-align:center;text-shadow: none!important;">узнай
                <br>как
                <br>обучать
                <br>сотрудников
                <br>поколения
                <br>
                <span style="font-size:74pt;line-height:65pt;">Y</span>
                <h4>
        </a>

    </div>
    <div class="sempermachina hereandhow">
        <a href="http://hereandnow.ru/" target="_blank" style="color:#000;font-size:12px;line-height:16pt;text-align:left;text-decoration:none;">
              В России на сегодняшний день для порядка <span style="font-size:14pt;border-bottom:1px solid #000;">120 000</span> детей домом является сиротское учреждение.<br>
              Это <span style="font-size:14pt;border-bottom:1px solid #000;">1500</span> детских домов, <span style="font-size:14pt;border-bottom:1px solid #000;">240</span> домов ребенка, более <span style="font-size:14pt;border-bottom:1px solid #000;">300</span> школ-интернатов для детей-сирот, более <span style="font-size:14pt;border-bottom:1px solid #000;">700</span> социальных приютов и <span style="font-size:14pt;border-bottom:1px solid #000;">750</span> социально-реабилитационных центров для детей и подростков.
              </a>
        <br>
        <br>
        <a href="http://hereandnow.ru/" target="_blank" style="color:#000;font-size:12px;line-height:16pt;text-align:left;text-decoration:underline;">Узнать подробнее о благотворительном фонде помощи детям-сиротам<br>"Здесь и Сейчас" →</a>
    </div>


</div>

        <div class="clearfix"></div>
</div>
