CKEDITOR.editorConfig = function(config) {
  config.indentClasses = ['rteindent1', 'rteindent2', 'rteindent3', 'rteindent4'];

  // [ Left, Center, Right, Justified ]
  config.justifyClasses = ['rteleft', 'rtecenter', 'rteright', 'rtejustify'];

  // The minimum editor width, in pixels, when resizing it with the resize handle.
  config.resize_minWidth = 450;

  // Protect PHP code tags (<?...?>) so CKEditor will not break them when
  // switching from Source to WYSIWYG.
  // Uncommenting this line doesn't mean the user will not be able to type PHP
  // code in the source. This kind of prevention must be done in the server
  // side
  // (as does Drupal), so just leave this line as is.
  config.protectedSource.push(/<\?[\s\S]*?\?>/g); // PHP Code

  config.extraPlugins = '';
  if (Drupal.ckeditorCompareVersion('3.1')) {
    config.extraPlugins += (config.extraPlugins ? ',drupalbreaks' : 'drupalbreaks');
  }
  if (Drupal.settings.ckeditor.linktocontent_node) {
    config.extraPlugins += (config.extraPlugins ? ',linktonode' : 'linktonode');
  }
  if (Drupal.settings.ckeditor.linktocontent_menu) {
    config.extraPlugins += (config.extraPlugins ? ',linktomenu' : 'linktomenu');
  }

  config.toolbar_DrupalFiltered = [
    ['Source'],
    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
    ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
    ['Link', 'Unlink', 'Anchor'],
    ['Image', 'Flash', '-', 'Table', 'HorizontalRule', 'SpecialChar'],
    ['Bold', 'Italic', 'Strike', '-', 'Subscript', 'Superscript'],
    ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'],
    ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
    ['DrupalBreak'],
    ['Maximize', 'ShowBlocks'],
    '/',
    ['Format', 'Styles']
  ];
  config.toolbar_DrupalBasic = [
    ['Source'],
    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
    ['Undo', 'Redo', '-', 'SelectAll', 'RemoveFormat'],
    ['Link', 'Unlink'],
    ['Bold', 'Italic']
  ];
  config.toolbar_Sandbox = [
    ['Source'],
    ['Undo', 'Redo'],
    ['Bold', 'Italic'],
    ['Flash'],
    ['DrupalBreak'],
    ['Maximize', 'ShowBlocks']
  ];

  /*
   * Append here extra CSS rules that should be applied into the editing area.
   * Example: 
   * config.extraCss = 'body {color:#FF0000;}';
   */
  config.extraCss = '';

  /**
   * CKEditor's editing area body ID & class.
   * See http://drupal.ckeditor.com/tricks
   * This setting can be used if CKEditor does not work well with your theme by default.
   */
  config.bodyId = 'page';
  config.bodyClass = 'cke';

  if (Drupal.ckeditorCompareVersion('3.1')) {
    CKEDITOR.plugins.addExternal('drupalbreaks', Drupal.settings.ckeditor.module_path + '/plugins/drupalbreaks/');
  }
  if (Drupal.settings.ckeditor.linktocontent_menu) {
    CKEDITOR.plugins.addExternal('linktomenu', Drupal.settings.ckeditor.module_path + '/plugins/linktomenu/');
    Drupal.settings.ckeditor.linktomenu_basepath = Drupal.settings.basePath;
  }
  if (Drupal.settings.ckeditor.linktocontent_node) {
    CKEDITOR.plugins.addExternal('linktonode', Drupal.settings.ckeditor.module_path + '/plugins/linktonode/');
    Drupal.settings.ckeditor.linktonode_basepath = Drupal.settings.basePath;
  }

  //'MediaEmbed' plugin. To enable it, uncomment lines below and add 'MediaEmbed' button to selected toolbars.
  //config.extraPlugins += (config.extraPlugins ? ',mediaembed' : 'mediaembed' );
  //CKEDITOR.plugins.addExternal('mediaembed', Drupal.settings.ckeditor.module_path + '/plugins/mediaembed/');

  Drupal.settings.ckeditor_swf.players = {
    'video/x-flv': {
      path: '/sites/all/libraries/mediaplayer/player.swf',
      offsetHeight: 24,
      fileName: 'file'
    },
    'audio/mpeg': {
      path: '/sites/all/libraries/audio-player/player.swf',
      offsetHeight: 0,
      fileName: 'soundFile',
      defaultWidth: 290,
      defaultHeight: 24
    }
  };
  config.extraPlugins += (config.extraPlugins ? ',swf' : 'swf');
  CKEDITOR.plugins.addExternal('swf', Drupal.settings.ckeditor_swf.module_path + '/plugins/swf/');

  //
  config.disableNativeSpellChecker = false;
  config.browserContextMenuOnCtrl = true;
  config.entities = false;
};