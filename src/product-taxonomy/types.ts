export type TaxonomyType = 'category' | 'subcategory';

export type TaxonomyOptionItem = {
  value: string;
  label: string;
  __isNew__?: boolean;
};

export type ApiOption = {
  id: number | string;
  label: string;
};

export type ApiError = {
  error?: string;
};

export type PostFields = Record<string, string | number>;

export type EditDialogState = {
  type: TaxonomyType;
  option: TaxonomyOptionItem;
  value: string;
  saving: boolean;
  error: string;
};

export type OptionAction = (type: TaxonomyType, option: TaxonomyOptionItem) => void | Promise<void>;
