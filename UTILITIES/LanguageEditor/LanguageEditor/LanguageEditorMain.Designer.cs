namespace LanguageEditor
{
    partial class LanguageEditorMain
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.gbCreate = new System.Windows.Forms.GroupBox();
            this.btnCreate = new System.Windows.Forms.Button();
            this.label2 = new System.Windows.Forms.Label();
            this.tbNewLanguageId = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.tbNewLanguageName = new System.Windows.Forms.TextBox();
            this.lvLanguageEditor = new System.Windows.Forms.ListView();
            this.chEditLang = ((System.Windows.Forms.ColumnHeader)(new System.Windows.Forms.ColumnHeader()));
            this.chEnglish = ((System.Windows.Forms.ColumnHeader)(new System.Windows.Forms.ColumnHeader()));
            this.label3 = new System.Windows.Forms.Label();
            this.cmbEditLanguage = new System.Windows.Forms.ComboBox();
            this.btnClose = new System.Windows.Forms.Button();
            this.btnSave = new System.Windows.Forms.Button();
            this.chKey = ((System.Windows.Forms.ColumnHeader)(new System.Windows.Forms.ColumnHeader()));
            this.gbCreate.SuspendLayout();
            this.SuspendLayout();
            // 
            // gbCreate
            // 
            this.gbCreate.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.gbCreate.Controls.Add(this.btnCreate);
            this.gbCreate.Controls.Add(this.label2);
            this.gbCreate.Controls.Add(this.tbNewLanguageId);
            this.gbCreate.Controls.Add(this.label1);
            this.gbCreate.Controls.Add(this.tbNewLanguageName);
            this.gbCreate.Location = new System.Drawing.Point(12, 12);
            this.gbCreate.Name = "gbCreate";
            this.gbCreate.Size = new System.Drawing.Size(757, 55);
            this.gbCreate.TabIndex = 0;
            this.gbCreate.TabStop = false;
            this.gbCreate.Text = "Create new language file";
            // 
            // btnCreate
            // 
            this.btnCreate.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.btnCreate.Location = new System.Drawing.Point(696, 19);
            this.btnCreate.Name = "btnCreate";
            this.btnCreate.Size = new System.Drawing.Size(55, 20);
            this.btnCreate.TabIndex = 4;
            this.btnCreate.Text = "Create";
            this.btnCreate.UseVisualStyleBackColor = true;
            this.btnCreate.Click += new System.EventHandler(this.btnCreate_Click);
            // 
            // label2
            // 
            this.label2.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(546, 22);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(72, 13);
            this.label2.TabIndex = 3;
            this.label2.Text = "Language ID:";
            // 
            // tbNewLanguageId
            // 
            this.tbNewLanguageId.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.tbNewLanguageId.Location = new System.Drawing.Point(624, 19);
            this.tbNewLanguageId.MaxLength = 2;
            this.tbNewLanguageId.Name = "tbNewLanguageId";
            this.tbNewLanguageId.Size = new System.Drawing.Size(36, 20);
            this.tbNewLanguageId.TabIndex = 2;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(6, 22);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(87, 13);
            this.label1.TabIndex = 1;
            this.label1.Text = "Language name:";
            // 
            // tbNewLanguageName
            // 
            this.tbNewLanguageName.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.tbNewLanguageName.Location = new System.Drawing.Point(99, 19);
            this.tbNewLanguageName.Name = "tbNewLanguageName";
            this.tbNewLanguageName.Size = new System.Drawing.Size(413, 20);
            this.tbNewLanguageName.TabIndex = 0;
            // 
            // lvLanguageEditor
            // 
            this.lvLanguageEditor.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.lvLanguageEditor.Columns.AddRange(new System.Windows.Forms.ColumnHeader[] {
            this.chEditLang,
            this.chEnglish,
            this.chKey});
            this.lvLanguageEditor.FullRowSelect = true;
            this.lvLanguageEditor.GridLines = true;
            this.lvLanguageEditor.HideSelection = false;
            this.lvLanguageEditor.LabelEdit = true;
            this.lvLanguageEditor.Location = new System.Drawing.Point(12, 100);
            this.lvLanguageEditor.MultiSelect = false;
            this.lvLanguageEditor.Name = "lvLanguageEditor";
            this.lvLanguageEditor.Size = new System.Drawing.Size(757, 338);
            this.lvLanguageEditor.TabIndex = 1;
            this.lvLanguageEditor.UseCompatibleStateImageBehavior = false;
            this.lvLanguageEditor.View = System.Windows.Forms.View.Details;
            this.lvLanguageEditor.AfterLabelEdit += new System.Windows.Forms.LabelEditEventHandler(this.lvLanguageEditor_AfterLabelEdit);
            // 
            // chEditLang
            // 
            this.chEditLang.Text = "<lang>";
            this.chEditLang.Width = 222;
            // 
            // chEnglish
            // 
            this.chEnglish.Text = "English";
            this.chEnglish.Width = 238;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(12, 76);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(75, 13);
            this.label3.TabIndex = 2;
            this.label3.Text = "Edit language:";
            // 
            // cmbEditLanguage
            // 
            this.cmbEditLanguage.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.cmbEditLanguage.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cmbEditLanguage.FormattingEnabled = true;
            this.cmbEditLanguage.Location = new System.Drawing.Point(93, 73);
            this.cmbEditLanguage.Name = "cmbEditLanguage";
            this.cmbEditLanguage.Size = new System.Drawing.Size(676, 21);
            this.cmbEditLanguage.TabIndex = 3;
            this.cmbEditLanguage.SelectedIndexChanged += new System.EventHandler(this.cmbEditLanguage_SelectedIndexChanged);
            // 
            // btnClose
            // 
            this.btnClose.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Right)));
            this.btnClose.DialogResult = System.Windows.Forms.DialogResult.Cancel;
            this.btnClose.Location = new System.Drawing.Point(694, 444);
            this.btnClose.Name = "btnClose";
            this.btnClose.Size = new System.Drawing.Size(75, 23);
            this.btnClose.TabIndex = 4;
            this.btnClose.Text = "Close";
            this.btnClose.UseVisualStyleBackColor = true;
            this.btnClose.Click += new System.EventHandler(this.btnClose_Click);
            // 
            // btnSave
            // 
            this.btnSave.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Right)));
            this.btnSave.Location = new System.Drawing.Point(613, 444);
            this.btnSave.Name = "btnSave";
            this.btnSave.Size = new System.Drawing.Size(75, 23);
            this.btnSave.TabIndex = 5;
            this.btnSave.Text = "Save";
            this.btnSave.UseVisualStyleBackColor = true;
            this.btnSave.Click += new System.EventHandler(this.btnSave_Click);
            // 
            // chKey
            // 
            this.chKey.Text = "Translation Key";
            this.chKey.Width = 247;
            // 
            // LanguageEditorMain
            // 
            this.AcceptButton = this.btnSave;
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.CancelButton = this.btnClose;
            this.ClientSize = new System.Drawing.Size(781, 479);
            this.Controls.Add(this.btnSave);
            this.Controls.Add(this.btnClose);
            this.Controls.Add(this.cmbEditLanguage);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.lvLanguageEditor);
            this.Controls.Add(this.gbCreate);
            this.MinimumSize = new System.Drawing.Size(500, 300);
            this.Name = "LanguageEditorMain";
            this.Text = "Custom Player Stats for Left 4 Dead - Language file editor";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.LanguageEditorMain_FormClosing);
            this.Load += new System.EventHandler(this.LanguageEditorMain_Load);
            this.gbCreate.ResumeLayout(false);
            this.gbCreate.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.GroupBox gbCreate;
        private System.Windows.Forms.Button btnCreate;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox tbNewLanguageId;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox tbNewLanguageName;
        private System.Windows.Forms.ListView lvLanguageEditor;
        private System.Windows.Forms.ColumnHeader chEditLang;
        private System.Windows.Forms.ColumnHeader chEnglish;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.ComboBox cmbEditLanguage;
        private System.Windows.Forms.Button btnClose;
        private System.Windows.Forms.Button btnSave;
        private System.Windows.Forms.ColumnHeader chKey;
    }
}

