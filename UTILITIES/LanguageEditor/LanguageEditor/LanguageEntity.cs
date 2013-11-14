using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Text.RegularExpressions;

namespace LanguageEditor
{
    public class LanguageEntity
    {
        public static readonly LanguageEntity DefaultLanguage = null;
        public const string LanguageFilenameRegexPattern = @"^language\.([A-Za-z]{2})\.php$";
        public static readonly string EmptyLanguagePhp;

        static LanguageEntity()
        {
            try
            {
                DefaultLanguage = Create("language.en.php");
            }
            catch (Exception)
            {
                DefaultLanguage = null;
            }

            const string resourceName = "LanguageEditor.language.EMPTY.php";
            Assembly assembly = Assembly.GetExecutingAssembly();

            using (Stream stream = assembly.GetManifestResourceStream(resourceName))
            {
                using (StreamReader reader = new StreamReader(stream))
                {
                    EmptyLanguagePhp = reader.ReadToEnd();
                }
            }
        }

        private LanguageEntity(string languageFilename)
        {
            TranslationEntities = new Dictionary<string, TranslationEntity>();
            string content;

            using (StreamReader sr = new StreamReader(languageFilename))
            {
                Filename = languageFilename;
                content = sr.ReadToEnd();

                MatchCollection matches = Regex.Matches(languageFilename, LanguageFilenameRegexPattern);

                if (matches.Count != 1 || matches[0].Groups.Count != 2)
                {
                    throw new ApplicationException("Language ID not found!");
                }

                Id = matches[0].Groups[1].Value;

                matches = Regex.Matches(content, @"\$lang_name( *?)=( *?)""(.*?)""( *?);");

                if (matches.Count > 0 && matches[0].Groups.Count == 5)
                {
                    Name = matches[0].Groups[3].Value;
                    HeaderTitle = string.Format("{0} ({1})", languageFilename, Name);
                }
                else
                {
                    HeaderTitle = Name = languageFilename;
                }

                matches = Regex.Matches(content, @"\$language_pack( *?)\[( *?)'(.*?)'( *?)\]( *?)=( *?)""(.*?)""( *?);");

                foreach (Match match in matches)
                {
                    string translationId = match.Groups[3].Value.ToLower();
                    string defaulTranslation = DefaultLanguage != null &&
                                               DefaultLanguage.TranslationEntities.ContainsKey(translationId)
                                                   ? DefaultLanguage.TranslationEntities[translationId].Translation
                                                   : string.Empty;
                    TranslationEntity translation = new TranslationEntity(this, translationId, match.Groups[7].Value, defaulTranslation);

                    if (TranslationEntities.ContainsKey(translationId))
                    {
                        TranslationEntities[translationId] = translation;
                    }
                    else
                    {
                        TranslationEntities.Add(translationId, translation);
                    }
                }

                if (DefaultLanguage != null)
                {
                    foreach (TranslationEntity translationEntity in DefaultLanguage.TranslationEntities.Values)
                    {
                        if (!TranslationEntities.ContainsKey(translationEntity.TranslationId))
                        {
                            TranslationEntities.Add(translationEntity.TranslationId,
                                                    new TranslationEntity(this, translationEntity.TranslationId,
                                                                          string.Empty, translationEntity.Translation));
                        }
                    }
                }
            }
        }

        public static bool IsValidLanguageFilename(string languageFilename)
        {
            return Regex.IsMatch(languageFilename, LanguageFilenameRegexPattern);
        }

        public static LanguageEntity Create(string languageFilename)
        {
            if (!IsValidLanguageFilename(languageFilename))
            {
                throw new ArgumentException(string.Format("Invalid language file name. ({0})", languageFilename));
            }

            return new LanguageEntity(languageFilename);
        }

        public override string ToString()
        {
            return HeaderTitle;
        }

        public void Save()
        {
            string emptyLanguage = EmptyLanguagePhp.Replace("%LANGNAME%", Name);

            List<string[]> langVarRows = new List<string[]>(TranslationEntities.Count);
            int langVarNameMaxLen = 0;

            foreach (KeyValuePair<string, TranslationEntity> translationKeyValuePairEntity in TranslationEntities)
            {
                string langVarValue = translationKeyValuePairEntity.Value.Translation;

                if (string.IsNullOrEmpty(langVarValue) || langVarValue.Trim().Length == 0)
                {
                    continue;
                }

                string langVarName = string.Format("$language_pack['{0}']", translationKeyValuePairEntity.Key);

                int langVarNameLen = langVarName.Length;

                if (langVarNameMaxLen < langVarNameLen)
                {
                    langVarNameMaxLen = langVarNameLen;
                }

                langVarRows.Add(new[] { langVarName, langVarValue });
            }

            StringBuilder sb = new StringBuilder();

            foreach (string[] langVarRow in langVarRows)
            {
                sb.AppendLine(string.Format("{0} = \"{1}\";", langVarRow[0].PadRight(langVarNameMaxLen), langVarRow[1]));
            }

            emptyLanguage = emptyLanguage.Replace("%LANGPACKROWS%", sb.ToString());

            using (StreamWriter sw = new StreamWriter(Filename, false, Encoding.UTF8))
            {
                sw.Write(emptyLanguage);
            }

            Edited = false;

            foreach (TranslationEntity translationEntity in TranslationEntities.Values)
            {
                translationEntity.Edited = false;
            }
        }

        public Dictionary<string, TranslationEntity> TranslationEntities { get; private set; }

        public string Filename { get; private set; }

        public string Name { get; private set; }

        public string HeaderTitle { get; private set; }

        public string Id { get; private set; }

        public bool Edited { get; set; }
    }
}
