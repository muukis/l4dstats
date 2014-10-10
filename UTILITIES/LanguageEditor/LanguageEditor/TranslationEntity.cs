using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace LanguageEditor
{
    public class TranslationEntity : ListViewItem
    {
        public TranslationEntity(LanguageEntity language, string translationId, string translation, string english)
            : base(UnsanitizeTranslation(translation))
        {
            Language = language;
            SubItems.Add(UnsanitizeTranslation(english));
            SubItems.Add(translationId);
        }

        public LanguageEntity Language { get; private set; }

        public string Translation
        {
            get { return SanitizeTranslation(Text.Trim()); }
            set { Text = UnsanitizeTranslation(value); }
        }

        public string English
        {
            get { return SanitizeTranslation(SubItems[1].Text); }
        }

        public string TranslationId
        {
            get { return SubItems[2].Text; }
        }

        public bool Edited { get; set; }

        public static string SanitizeTranslation(string translation)
        {
            if (string.IsNullOrEmpty(translation))
            {
                return string.Empty;
            }

            translation = translation.Replace(@"\", @"\\");
            translation = translation.Replace("\"", "\\\"");

            return translation;
        }

        public static string UnsanitizeTranslation(string sanitizedTranslation)
        {
            if (string.IsNullOrEmpty(sanitizedTranslation))
            {
                return string.Empty;
            }

            sanitizedTranslation = sanitizedTranslation.Replace("\\\"", "\"");
            sanitizedTranslation = sanitizedTranslation.Replace(@"\\", @"\");

            return sanitizedTranslation;
        }
    }
}
