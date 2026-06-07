import { useEffect, useState } from 'react';
import type { FormEvent } from 'react';
import CreatableSelect from 'react-select/creatable';
import type { GroupBase } from 'react-select';
import { errorMessage, normalize, postAction, requestJson, taxonomyApi, toOption } from './api';
import { EditModal } from './EditModal';
import { selectStyles } from './selectStyles';
import { createTaxonomyOption } from './TaxonomyOption';
import type { ApiOption, EditDialogState, OptionAction, PostFields, TaxonomyOptionItem } from './types';

type ProductTaxonomySelectsProps = {
  root: HTMLElement;
};

export function ProductTaxonomySelects({ root }: ProductTaxonomySelectsProps) {
  const initialCategoryId = root.dataset.categoryId || '';
  const initialSubcategoryId = root.dataset.subcategoryId || '';
  const categoryInputId = root.dataset.categoryInput || '';
  const subcategoryInputId = root.dataset.subcategoryInput || '';
  const categoryInput = categoryInputId ? document.getElementById(categoryInputId) as HTMLInputElement | null : null;
  const subcategoryInput = subcategoryInputId ? document.getElementById(subcategoryInputId) as HTMLInputElement | null : null;

  const [categories, setCategories] = useState<TaxonomyOptionItem[]>([]);
  const [subcategories, setSubcategories] = useState<TaxonomyOptionItem[]>([]);
  const [category, setCategory] = useState<TaxonomyOptionItem | null>(null);
  const [subcategory, setSubcategory] = useState<TaxonomyOptionItem | null>(null);
  const [loadingCategories, setLoadingCategories] = useState(false);
  const [loadingSubcategories, setLoadingSubcategories] = useState(false);
  const [creatingCategory, setCreatingCategory] = useState(false);
  const [creatingSubcategory, setCreatingSubcategory] = useState(false);
  const [dialog, setDialog] = useState<EditDialogState | null>(null);
  const [error, setError] = useState('');

  const selectedCategoryId = category?.value || '';

  useEffect(() => {
    let active = true;

    setLoadingCategories(true);
    requestJson<ApiOption[]>(taxonomyApi.categories)
      .then((items) => {
        if (!active) return;

        const options = items.map(toOption);
        setCategories(options);

        if (initialCategoryId) {
          const selected = options.find((option) => option.value === String(initialCategoryId));
          if (selected) {
            setCategory(selected);
          }
        }
      })
      .catch((err) => setError(errorMessage(err)))
      .finally(() => {
        if (active) setLoadingCategories(false);
      });

    return () => {
      active = false;
    };
  }, [initialCategoryId]);

  useEffect(() => {
    if (categoryInput) {
      categoryInput.value = category?.value || '';
    }
  }, [category, categoryInput]);

  useEffect(() => {
    if (subcategoryInput) {
      subcategoryInput.value = subcategory?.value || '';
    }
  }, [subcategory, subcategoryInput]);

  useEffect(() => {
    let active = true;

    if (!selectedCategoryId) {
      setSubcategories([]);
      setSubcategory(null);
      return undefined;
    }

    setLoadingSubcategories(true);
    requestJson<ApiOption[]>(taxonomyApi.subcategories(selectedCategoryId))
      .then((items) => {
        if (!active) return;

        const options = items.map(toOption);
        setSubcategories(options);

        if (initialSubcategoryId) {
          const selected = options.find((option) => option.value === String(initialSubcategoryId));
          setSubcategory(selected || null);
        }
      })
      .catch((err) => setError(errorMessage(err)))
      .finally(() => {
        if (active) setLoadingSubcategories(false);
      });

    return () => {
      active = false;
    };
  }, [selectedCategoryId, initialSubcategoryId]);

  useEffect(() => {
    const form = root.closest('form');
    if (!form) return undefined;

    const handleSubmit = (event: SubmitEvent) => {
      if (!category?.value || !subcategory?.value) {
        event.preventDefault();
        setError('Seleccione una categoría y una subcategoría antes de guardar.');
      }
    };

    form.addEventListener('submit', handleSubmit);
    return () => form.removeEventListener('submit', handleSubmit);
  }, [category, root, subcategory]);

  const createCategory = async (inputValue: string) => {
    const name = normalize(inputValue);
    if (!name) return;

    setError('');
    setCreatingCategory(true);

    try {
      const data = await postAction('createCategory', { name });
      const option = toOption(data);

      setCategories((current) => {
        const exists = current.some((item) => item.value === option.value);
        return exists ? current : [...current, option];
      });
      setCategory(option);
      setSubcategory(null);
      setSubcategories([]);
    } catch (err) {
      setError(errorMessage(err));
    } finally {
      setCreatingCategory(false);
    }
  };

  const createSubcategory = async (inputValue: string) => {
    const name = normalize(inputValue);
    if (!name || !selectedCategoryId) return;

    setError('');
    setCreatingSubcategory(true);

    try {
      const data = await postAction('createSubcategory', {
        category_id: selectedCategoryId,
        name
      });
      const option = toOption(data);

      setSubcategories((current) => {
        const exists = current.some((item) => item.value === option.value);
        return exists ? current : [...current, option];
      });
      setSubcategory(option);
    } catch (err) {
      setError(errorMessage(err));
    } finally {
      setCreatingSubcategory(false);
    }
  };

  const openEditDialog: OptionAction = (type, option) => {
    setError('');
    setDialog({
      type,
      option,
      value: option.label,
      saving: false,
      error: ''
    });
  };

  const updateDialogValue = (value: string) => {
    setDialog((current) => current && { ...current, value, error: '' });
  };

  const saveDialog = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    if (!dialog) return;

    const name = normalize(dialog.value);
    if (!name) {
      setDialog((current) => current && { ...current, error: 'Ingrese un nombre antes de guardar.' });
      return;
    }

    setError('');
    setDialog((current) => current && { ...current, saving: true });

    try {
      const action = dialog.type === 'category' ? 'updateCategory' : 'updateSubcategory';
      const fields: PostFields = {
        id: dialog.option.value,
        name
      };

      if (dialog.type === 'subcategory') {
        fields.category_id = selectedCategoryId;
      }

      const data = await postAction(action, fields);
      const updated = toOption(data);

      if (dialog.type === 'category') {
        setCategories((current) => current.map((item) => (item.value === updated.value ? updated : item)));
        setCategory((current) => (current?.value === updated.value ? updated : current));
      } else {
        setSubcategories((current) => current.map((item) => (item.value === updated.value ? updated : item)));
        setSubcategory((current) => (current?.value === updated.value ? updated : current));
      }

      setDialog(null);
    } catch (err) {
      setDialog((current) => current && { ...current, saving: false, error: errorMessage(err) });
    }
  };

  const deleteOption: OptionAction = async (type, option) => {
    const resourceName = type === 'category' ? 'categoría' : 'subcategoría';
    const confirmed = window.confirm(`Se eliminará la ${resourceName} "${option.label}". ¿Desea continuar?`);

    if (!confirmed) return;

    setError('');

    try {
      const action = type === 'category' ? 'deleteCategory' : 'deleteSubcategory';
      await postAction<{ id: number | string }>(action, { id: option.value });

      if (type === 'category') {
        setCategories((current) => current.filter((item) => item.value !== option.value));

        if (category?.value === option.value) {
          setCategory(null);
          setSubcategory(null);
          setSubcategories([]);
        }
      } else {
        setSubcategories((current) => current.filter((item) => item.value !== option.value));

        if (subcategory?.value === option.value) {
          setSubcategory(null);
        }
      }
    } catch (err) {
      setError(errorMessage(err));
    }
  };

  const selectMessages = {
    categoryPlaceholder: 'Buscar o crear categoría',
    subcategoryPlaceholder: selectedCategoryId
      ? 'Buscar o crear subcategoría'
      : 'Seleccione una categoría primero',
    noOptionsMessage: () => 'Sin resultados',
    formatCreateLabel: (inputValue: string) => `Crear "${inputValue}"`
  };

  const sharedSelectProps = {
    classNamePrefix: 'product-taxonomy',
    styles: selectStyles,
    isClearable: true,
    noOptionsMessage: selectMessages.noOptionsMessage,
    formatCreateLabel: selectMessages.formatCreateLabel
  };

  return (
    <div className="product-taxonomy-selects">
      <div className="form-group">
        <label htmlFor="productCategorySelect">Categoría:</label>
        <CreatableSelect<TaxonomyOptionItem, false, GroupBase<TaxonomyOptionItem>>
          {...sharedSelectProps}
          inputId="productCategorySelect"
          components={{ Option: createTaxonomyOption('category', openEditDialog, deleteOption) }}
          options={categories}
          value={category}
          isDisabled={loadingCategories || creatingCategory}
          isLoading={loadingCategories || creatingCategory}
          placeholder={selectMessages.categoryPlaceholder}
          onChange={(option) => {
            setError('');
            setCategory(option);
            setSubcategory(null);
          }}
          onCreateOption={createCategory}
        />
      </div>

      <div className="form-group">
        <label htmlFor="productSubcategorySelect">Subcategoría:</label>
        <CreatableSelect<TaxonomyOptionItem, false, GroupBase<TaxonomyOptionItem>>
          {...sharedSelectProps}
          inputId="productSubcategorySelect"
          components={{ Option: createTaxonomyOption('subcategory', openEditDialog, deleteOption) }}
          options={subcategories}
          value={subcategory}
          isDisabled={!selectedCategoryId || loadingSubcategories || creatingSubcategory}
          isLoading={loadingSubcategories || creatingSubcategory}
          placeholder={selectMessages.subcategoryPlaceholder}
          onChange={(option) => {
            setError('');
            setSubcategory(option);
          }}
          onCreateOption={createSubcategory}
        />
      </div>

      {error && <div className="alert alert-danger py-2 product-taxonomy-error">{error}</div>}

      <EditModal
        dialog={dialog}
        onCancel={() => setDialog(null)}
        onChange={updateDialogValue}
        onSave={saveDialog}
      />
    </div>
  );
}
