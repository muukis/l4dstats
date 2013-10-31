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
            get { return SubItems[1].Text; }
        }

        public string TranslationId
        {
            get { return SubItems[2].Text; }
        }

        public bool Edited { get; set; }
    }
}
