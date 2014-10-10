using System;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace LanguageEditor
{
    public class LanguageEditViewSorter : IComparer
    {
	    private int columnToSort = 0;
        private SortOrder orderOfSort = SortOrder.None;

        public int Compare(object x, object y)
        {
            if (orderOfSort == SortOrder.None || !(x is TranslationEntity) || !(y is TranslationEntity))
            {
                return 0;
            }

            TranslationEntity translationEntityX = (TranslationEntity)x;
            TranslationEntity translationEntityY = (TranslationEntity)y;

            int sortOrder = orderOfSort == SortOrder.Ascending ? 1 : -1;

            return sortOrder * string.Compare(translationEntityX.SubItems[columnToSort].Text.Trim(),
                                              translationEntityY.SubItems[columnToSort].Text.Trim(),
                                              StringComparison.InvariantCulture);
        }

        public int SortColumn
        {
            set
            {
                columnToSort = value;
            }
            get
            {
                return columnToSort;
            }
        }

        public SortOrder Order
        {
            set
            {
                orderOfSort = value;
            }
            get
            {
                return orderOfSort;
            }
        }
    }
}
