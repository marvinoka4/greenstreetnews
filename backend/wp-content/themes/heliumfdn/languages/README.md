## Translations

The `languages/` folder contains translation files for the helium-fdn theme.

- `helium-fdn.pot`: Template file with translatable strings.
- Language files (e.g., `helium-fdn-fr_FR.mo`, `helium-fdn-fr_FR.po`) are loaded based on WordPress's locale (e.g., `fr_FR`). 
- - Included translations:
- Spanish (`es_ES`)
- French (`fr_FR`)
- German (`de_DE`)
- Portuguese (`pt_BR`)
- Add new languages by creating `.po`/`.mo` files with Poedit.

### How to Translate helium-fdn

1. Open `languages/helium-fdn.pot` in [Poedit](https://poedit.net/).
2. Create translation for your locale (e.g., `it_IT`).
3. Save as `helium-fdn-LOCALE.po` (e.g., `helium-fdn-fr_FR.po`); Poedit generates the `.mo` file.
4. Place both `.po` and `.mo` files in `wp-content/themes/helium-fdn/languages/`.
5. Set WordPress locale in Settings > General > Site Language.
6. Replace yourwebsite.com, yourdomain.com, Your Name, etc., before distributing.
   Example:
7. "Report-Msgid-Bugs-To: https://heliumfdn.com/support\n"
   "Last-Translator: Marvin Okafor <support@heliumfdn.com>\n"
   "Language-Team: Helium FDN Team <support@heliumfdn.com>\n"

### More Resources
- [WordPress i18n Guide](https://developer.wordpress.org/themes/functionality/internationalization/)