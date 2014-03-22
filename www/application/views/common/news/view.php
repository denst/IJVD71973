<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=383676201686425";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="navsec">
	<a href="http://feeds.feedburner.com/axespro" class="btn btn-warning rss" target="_blank">Подписаться через RSS</a>
	<h1><?php echo $news->title;?></h1>

</div>
<?php $categories = Kohana::$config->load('default.categories'); ?>
<div id="contentWrap">

        <div id="content">

            <div class="news-item news-no-border ">

                <?php echo $news->text;?>


                <div class="entry-meta">
                    <div class="post-tags-in">
                    <?php foreach ($news->tags->find_all() as $tag): ?>
                         <?php echo HTML::anchor(URL::site('news/tags/'. $tag->title), $tag->title); ?>
                    <?php endforeach; ?>
					<div class="clearfix"></div>
					<span class="post-date"><i class="icon-calendar"></i><?php echo $news->date_format(); ?></span>
                        <?php if($news->category): ?>
                        <span class="post-tags"><?php echo HTML::anchor(URL::site('news/categories/'.@$categories[$news->category]), @$categories[$news->category]);?></span>
                        <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div> <!-- end news item -->
			<div class="hrnoline"></div>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f6d901442c654ff"></script>
<!-- AddThis Button END -->
                <div class="two-third">
			<div class="hr2"></div>
			<h4>Комментарии:</h4>
		<div class="fb-comments" data-href="http://axes.pro<?php  print_r($_SERVER['REQUEST_URI']); ?>" data-num-posts="13" data-width="640"></div>
		<!--<div class="hr2"></div>

			<h4>Локальные комментарии:</h4>
			<p>Вы можете оставить свои комментарии зарегистрировавшись или через аккаунты в Facebook и LinkedIn</p>
                                <?php if (!Auth::instance()->logged_in() && !$linkedin_logged_in && !$facebook_logged_in): ?>
				<a class="btn btn-blue-primar conreg" href="<?php echo URL::site('oauth/facebook'); ?>"><i class="icon-user icon-white"></i> Войти через Facebook</a>
				<a class="btn btn-info conreg" href="<?php echo URL::site('oauth/linkedin'); ?>"><i class="icon-user icon-white"></i> Войти через LinkedIn</a>
				<a class="btn btn-success conreg" href="<?php echo URL::site('private/register');?>"><i class="icon-user icon-white"></i>Регистрация</a>
                                <?php endif; ?>
<div class="hrnoline"></div>
                                <a name="comments"></a>



                                <?php if($news->comments->count_all()): ?>
                                <?php foreach($news->comments->order_by('created', 'asc')->find_all() as $comment): ?>
				<div class="commentWrap">
					<div class="user-info">
						<div class="img"><img alt="demo" src="<?php echo URL::base(); ?>assets/images/bogart.gif"></div>
						<div class="info">
                                                    <p class="name"><?php echo $comment->user_id ? htmlspecialchars($comment->user->firstname . " " . $comment->user->lastname) : ($comment->name ? $comment->name : "Аноним"); ?></p>
                                                    <p class="date"><?php echo date('d-m-y, H:i', $comment->created); ?></p>
                                                </div>
					</div>
					<div class="comment">
                                                <?php if (Auth::instance()->logged_in("admin")): ?>
                                                <?php echo Html::anchor(URL::site('news/commentdelete/' . $comment->id), "Удалить комментарий", array("onclick" => "if (!confirm('Вы уверены, что хотите удалить комментарий?')) return false;")); ?>
                                                <?php endif; ?>
						<p>
                                                    <?php echo nl2br(htmlspecialchars($comment->text)); ?>
                                                </p>
					</div>
				</div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    Комментариев нет
                                <?php endif;?>

				<div class="hr2"></div>

				<h4>Оставить комментарий</h4>
				<form action="<?php echo URL::site('news/comment/' . $news->id);?>" method="post" id="newsForm2" class="cmxform">
                                <?php if (Auth::instance()->logged_in()): ?>
					<fieldset>

						<p>
                                                    <textarea id="bcomment" name="text" class="required" rows="10" cols="30"></textarea>
						</p>

					</fieldset>
                                <?php else: ?>
					<fieldset>

						<p>
                                                    <textarea id="bcomment" name="text" class="required" rows="10" cols="30"></textarea>
						</p>
                                                <?php if (!$linkedin_logged_in && !$facebook_logged_in): ?>
						<p class="spam">
                                                        <p><?php echo $captcha->render(TRUE);?></p>
							<input type="text" id="ccheck" value="" class="required" name="ccheck">

						</p>
                                                <?php endif; ?>
					</fieldset>
                                <?php endif; ?>
					<p><button name="sendmail" type="submit" class="btn btn-primary">Отправить</button></p>
				</form> -->
			</div>
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
            <div class="sempermachina" style="overflow:auto;">
                <div class="post-tags-in">
                  <?php $cnt = 0; ?>
                  <?php foreach (ORM::factory('tag')->find_all() as $tag): ?>
                       <?php if ($cnt < 34): ?>
                       <?php if ($tag->news->count_all()): ?>
                       <?php echo HTML::anchor(URL::site('news/tags/'. $tag->title), $tag->title); ?>
                       <?php $cnt++; ?>
                       <?php endif; ?>
                       <?php endif; ?>
                  <?php endforeach; ?>
                </div>
            </div>
            <div class="sempermachina getetweb">
                <a href="<?= Kohana::$base_url ?>promo/getetweb/" target="_blank">
                    <h4 style="font-variant: small-caps;color:#fff;font-size:27pt;font-weight:800;letter-spacing:4px;line-height:23pt;text-align:center;font-style:italic;text-shadow: none!important;">шаг вперед
                        <br>в управлении талантами</h4>
                </a>
            </div>
            <div class="sempermachina hereandhow">
                <a href="http://hereandnow.ru/" target="_blank" style="color:#000;font-size:12px;line-height:16pt;text-align:left;text-decoration:none;">
                      В России на сегодняшний день для порядка <span style="font-size:14pt;border-bottom:1px solid #000;">120 000</span> детей домом является сиротское учреждение. <br>
                      Это <span style="font-size:14pt;border-bottom:1px solid #000;">1500</span> детских домов, <span style="font-size:14pt;border-bottom:1px solid #000;">240</span> домов ребенка, более <span style="font-size:14pt;border-bottom:1px solid #000;">300</span> школ-интернатов для детей-сирот, более <span style="font-size:14pt;border-bottom:1px solid #000;">700</span> социальных приютов и <span style="font-size:14pt;border-bottom:1px solid #000;">750</span> социально-реабилитационных центров для детей и подростков.
                      </a>
                <br>
                <br>
                <a href="http://hereandnow.ru/" target="_blank" style="color:#000;font-size:12px;line-height:16pt;text-align:left;text-decoration:underline;">Узнать подробнее о благотворительном фонде помощи детям-сиротам<br>"Здесь и Сейчас" →</a>
            </div>

        </div>

         <!-- end column -->
        <div class="clearfix"></div>
</div>