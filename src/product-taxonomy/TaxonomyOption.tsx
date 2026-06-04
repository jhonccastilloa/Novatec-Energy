import type { MouseEvent } from 'react';
import { components } from 'react-select';
import type { GroupBase, OptionProps } from 'react-select';
import type { OptionAction, TaxonomyOptionItem, TaxonomyType } from './types';

export function createTaxonomyOption(
  taxonomyType: TaxonomyType,
  onEditOption: OptionAction,
  onDeleteOption: OptionAction
) {
  return function TaxonomyOption(
    props: OptionProps<TaxonomyOptionItem, false, GroupBase<TaxonomyOptionItem>>
  ) {
    const { data } = props;

    if (data.__isNew__) {
      return <components.Option {...props} />;
    }

    const stopSelect = (event: MouseEvent<HTMLButtonElement>) => {
      event.preventDefault();
      event.stopPropagation();
    };

    return (
      <components.Option {...props}>
        <span className="product-taxonomy-option-label">{data.label}</span>
        <span className="product-taxonomy-option-actions">
          <button
            type="button"
            className="product-taxonomy-option-btn"
            title="Editar"
            onMouseDown={(event) => {
              stopSelect(event);
              onEditOption(taxonomyType, data);
            }}
            aria-label={`Editar ${data.label}`}
          >
            <i className="fas fa-pen" aria-hidden="true"></i>
          </button>
          <button
            type="button"
            className="product-taxonomy-option-btn product-taxonomy-option-btn-danger"
            title="Eliminar"
            onMouseDown={(event) => {
              stopSelect(event);
              onDeleteOption(taxonomyType, data);
            }}
            aria-label={`Eliminar ${data.label}`}
          >
            <i className="fas fa-trash" aria-hidden="true"></i>
          </button>
        </span>
      </components.Option>
    );
  };
}
