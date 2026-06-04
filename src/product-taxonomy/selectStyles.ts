import type { StylesConfig } from 'react-select';
import type { TaxonomyOptionItem } from './types';

export const selectStyles: StylesConfig<TaxonomyOptionItem, false> = {
  option: (base) => ({
    ...base,
    alignItems: 'center',
    display: 'flex',
    gap: '0.75rem',
    justifyContent: 'space-between',
    minHeight: 44
  })
};
