using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Globalization;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Windows.Forms;

namespace LanguageEditor
{
    public partial class LanguageEditorMain : Form
    {
        private List<LanguageEntity> languageEntities = new List<LanguageEntity>();
        private LanguageEditViewSorter sorter = new LanguageEditViewSorter();

        public LanguageEditorMain()
        {
            InitializeComponent();
            lvLanguageEditor.ListViewItemSorter = sorter;
        }

        private void btnSave_Click(object sender, EventArgs e)
        {
            if (languageEntities.Count(o => o.Edited) == 0)
            {
                MessageBox.Show("There is nothing to save at the moment.", "Save", MessageBoxButtons.OK, MessageBoxIcon.Hand);
                return;
            }

            foreach (LanguageEntity languageEntity in languageEntities)
            {
                if (languageEntity.Edited)
                {
                    languageEntity.Save();
                }
            }

            MessageBox.Show("Modified language files successfully saved.", "Save", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }

        private void LanguageEditorMain_Load(object sender, EventArgs e)
        {
            if (LanguageEntity.DefaultLanguage == null)
            {
                MessageBox.Show("Default language not found!", "ERROR", MessageBoxButtons.OK, MessageBoxIcon.Error);
                Close();
            }

            DirectoryInfo di = new DirectoryInfo(AppDomain.CurrentDomain.BaseDirectory);

            foreach (FileInfo languageFile in di.GetFiles("language.??.php"))
            {
                if (!LanguageEntity.IsValidLanguageFilename(languageFile.Name))
                {
                    continue;
                }

                try
                {
                    LanguageEntity languageEntity = LanguageEntity.Create(languageFile.Name);
                    languageEntities.Add(languageEntity);
                }
                catch (Exception ex)
                {
                    MessageBox.Show(
                        string.Format("Cannot parse language file {0}. Error: {1}", languageFile.Name, ex.Message),
                        "WARNING", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
            }

            cmbEditLanguage.Items.AddRange(languageEntities.ToArray());
            cmbEditLanguage.SelectedIndex = 0;
        }

        private void cmbEditLanguage_SelectedIndexChanged(object sender, EventArgs e)
        {
            lvLanguageEditor.Items.Clear();

            if (!(sender is ComboBox) || ((ComboBox)sender).SelectedIndex < 0 ||
                !(((ComboBox) sender).SelectedItem is LanguageEntity))
            {
                return;
            }

            LanguageEntity languageEntity = ((ComboBox)sender).SelectedItem as LanguageEntity;
            lvLanguageEditor.Items.AddRange(languageEntity.TranslationEntities.Values.ToArray());
            chEditLang.Text = languageEntity.Name;
        }

        private void lvLanguageEditor_AfterLabelEdit(object sender, LabelEditEventArgs e)
        {
            if (!(sender is ListView) || !(((ListView)sender).Items[e.Item] is TranslationEntity))
            {
                return;
            }

            TranslationEntity translationEntity = lvLanguageEditor.Items[e.Item] as TranslationEntity;

            if (e.Label != null && string.Compare(e.Label.Trim(), translationEntity.Translation, StringComparison.InvariantCulture) != 0)
            {
                translationEntity.Edited = true;
                translationEntity.Language.Edited = true;
            }
        }

        private void btnClose_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void LanguageEditorMain_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (languageEntities.Count(o => o.Edited) > 0 &&
                MessageBox.Show(
                    "There are unsaved modifications in the language files! Are you sure you want to close the application?",
                    "Close?", MessageBoxButtons.YesNo, MessageBoxIcon.Question) == DialogResult.No)
            {
                e.Cancel = true;
            }
        }

        private void btnCreate_Click(object sender, EventArgs e)
        {
            string lanquageName = tbNewLanguageName.Text.Trim();
            string languageId = tbNewLanguageId.Text.ToLower().Trim();

            if (lanquageName.Length == 0)
            {
                MessageBox.Show(string.Format("Invalid language name \"{0}\".", lanquageName),
                                "Create", MessageBoxButtons.OK, MessageBoxIcon.Warning);

                tbNewLanguageName.Focus();
                return;
            }

            if (languageId.Length != 2 || !Regex.IsMatch(languageId, "^[a-z]{2}$"))
            {
                MessageBox.Show(string.Format("Invalid language ID \"{0}\". Two characrets (a-z) expected.", languageId),
                                "Create", MessageBoxButtons.OK, MessageBoxIcon.Warning);

                tbNewLanguageId.Focus();
                return;
            }

            if (languageEntities.Count(o => o.Id == languageId) > 0)
            {
                MessageBox.Show(string.Format("Language with a language ID \"{0}\" already exists.", languageId),
                                "Create", MessageBoxButtons.OK, MessageBoxIcon.Warning);

                tbNewLanguageId.Focus();
                return;
            }

            string languageFilename = string.Format("language.{0}.php", languageId);

            using (StreamWriter sr = new StreamWriter(languageFilename, false, Encoding.UTF8))
            {
                string emptyLanguage = LanguageEntity.EmptyLanguagePhp.Replace("%LANGNAME%", lanquageName);
                emptyLanguage = emptyLanguage.Replace("%LANGPACKROWS%", string.Empty);
                sr.Write(emptyLanguage);
            }

            LanguageEntity languageEntity = LanguageEntity.Create(languageFilename);

            languageEntities.Add(languageEntity);
            cmbEditLanguage.SelectedIndex = cmbEditLanguage.Items.Add(languageEntity);

            MessageBox.Show("Language file successfully created.", "Create", MessageBoxButtons.OK,
                            MessageBoxIcon.Information);

            tbNewLanguageName.Text = string.Empty;
            tbNewLanguageId.Text = string.Empty;
        }

        private void lvLanguageEditor_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            OpenLabelEditor();
        }

        private void OpenLabelEditor()
        {
            if (lvLanguageEditor.SelectedItems.Count != 1)
            {
                return;
            }

            lvLanguageEditor.SelectedItems[0].BeginEdit();
        }

        private void LanguageEditorMain_KeyDown(object sender, KeyEventArgs e)
        {
            if (lvLanguageEditor.Focused && (e.KeyData == Keys.Enter || e.KeyData == Keys.Space))
            {
                OpenLabelEditor();
                e.SuppressKeyPress = true;
            }
        }

        private void lvLanguageEditor_ColumnClick(object sender, ColumnClickEventArgs e)
        {
            if (e.Column == sorter.SortColumn)
            {
                if (sorter.Order == SortOrder.Ascending)
                {
                    sorter.Order = SortOrder.Descending;
                }
                else
                {
                    sorter.Order = SortOrder.Ascending;
                }
            }
            else
            {
                sorter.SortColumn = e.Column;
                sorter.Order = SortOrder.Ascending;
            }

            lvLanguageEditor.Sort();
        }
    }
}
