			</td>
        </tr>
      </table>
      <table id="footer" width="100%" border="0">
        <tr>
          <td><?php echo __('Page chargé en '); $endtime = getmicrotime(); echo round(($endtime-$starttime)*1000000);  echo __(' millisecondes. ');  ?></td>
          <td></td>
          <td align="right">&copy; Active <sup style="font-size:0.7em;">CMS</sup> <?php echo $app_years; ?> <?php echo $version; ?> | <?php echo __('Propulsé par'); ?> <a href="<?php echo $url_author; ?>" target="_blanc"><?php echo $author; ?></a></td>
        </tr>
      </table></td>
  </tr>
</table>
<div id="about" style="display:none;">
  <h1 style="color:#999;"><?php echo __('A Propos'); ?></h1>
  <br />
  <p style="text-align: justify;"> <span style="color:#4E8CBB; font-weight:bold">Active CMS 1.2.0</span><br />
    <br />
    <?php echo __('C\'est une solution entièrement basée sur PHP/Mysql, jQuery et AJAX'); ?><br />
    <br />
    <?php echo __('Active CMS est un gestionnaire de contenu, vous pouvez éditer en toute simplicité une page Web à l\'aide de votre navigateur. L’interface est orientée vers l’utilisateur. Colorée, il est structurée de manière familière... Cette application est extrêmement léger et ne pèse que 2.25 Mo sans l\'editeur WYSIWYG, qui fait 3.1 Mo.'); ?><br />
    <br />
    <?php echo __('Pour télécharger l\'application retourner vers cette'); ?> <a style="color:#f30" target="_blanc" href="http://www.activedev.net/activecms">page</a> <?php echo __('onglet téléchargement.'); ?><br />
    <br />
    <?php echo __('Si vous avez une remarque, un quelconque suggestion, veillez me le faire parvenir... que vous aimez bien, n\'hésitez surtout pas à m\'en faire part. Merci'); ?><br />
    <br />
  </p>
  <a href="#" onclick="$('#about').fadeOut(1000); return false;"><?php echo __('Fermer'); ?></a><br />
</div>
</body>
</html>