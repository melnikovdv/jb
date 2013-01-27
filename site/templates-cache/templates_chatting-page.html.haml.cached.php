<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Общение') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <h3>Общение</h3>
      <p>Здесь вы можете задать интересующие вас вопросы, сделать заказ на поиск дисков, оставить отзыв об этом сервисе.</p>
      <div <?php atts(array('id' => 'disqus_thread', 'class' => 'disqus')); ?>></div>
      <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'boogiewoogieru'; // required: replace example with your forum shortname
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
      </script>
      <noscript></noscript>
      Please enable JavaScript to view the
      <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
      <a <?php atts(array('class' => 'dsq-brlink', 'href' => "http://disqus.com")); ?>></a>
      comments powered by
      <span <?php atts(array('class' => 'logo-disqus')); ?>>Disqus</span>
      <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'boogiewoogieru'; // required: replace example with your forum shortname
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
      </script>
    </div>
  </body>
</html>
