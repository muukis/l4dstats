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
            : base(translation)
        {
            Language = language;
            TranslationId = translationId;
            SubItems.Add(english);
            SubItems.Add(translationId);
        }

        public LanguageEntity Language { get; private set; }

        public string Translation
        {
            get { return Text.Trim(); }
            set { Text = value; }
        }

        public string English
        {
            get { return Text.Trim(); }
            set { Text = value; }
        }

        public string TranslationId { get; private set; }

        public bool Edited { get; set; }
    }
}
