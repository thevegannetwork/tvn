How to prepare export?

1. Create a menu called "Primary" if you want to assign to main menu automatically on import.
2. If page is used as front page use slug "home" for the page. Otherwise it won't be assigned automatically.
2. Use http://wordpress.org/plugins/widget-settings-importexport/ to export widgets and save in sample-data folder as widget_data.json.
3. Export Redux settings in Appearance>Theme options>Import/Export. Click "Download Data File" and save file in sample-data folder as redux.json.
4. Use WP exporter to export content. Go to Tools>Export, choose "All Content" radio button and click "Download Export File". Save file as data.xml in sample-data folder.
5. Export all sliders if theme supports Revolution Slider. Go to Revolution Slider in admin panel and use "Export Slider" button for each slider. Save zipped sliders in sample-data/revslider folder.
6. Update a list of demos to import on theme_name/admin/options/export.php, section id: opt-import-template
