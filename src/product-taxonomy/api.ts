import type { ApiError, ApiOption, PostFields, TaxonomyOptionItem } from './types';

const apiUrl = window.location.pathname.includes('/administrador/')
  ? './taxonomyApi.php'
  : './administrador/taxonomyApi.php';

export const toOption = (item: ApiOption): TaxonomyOptionItem => ({
  value: String(item.id),
  label: item.label
});

export const normalize = (value: string): string => value.trim().replace(/\s+/g, ' ');

export const errorMessage = (error: unknown): string => (
  error instanceof Error ? error.message : 'No se pudo completar la solicitud.'
);

export async function requestJson<T>(url: string, options: RequestInit = {}): Promise<T> {
  const response = await fetch(url, options);
  const data = await response.json().catch(() => ({})) as T & ApiError;

  if (!response.ok || data.error) {
    throw new Error(data.error || 'No se pudo completar la solicitud.');
  }

  return data;
}

export async function postAction<T = ApiOption>(action: string, fields: PostFields): Promise<T> {
  const formData = new FormData();
  formData.append('action', action);

  Object.entries(fields).forEach(([key, value]) => {
    formData.append(key, String(value));
  });

  return requestJson<T>(apiUrl, {
    method: 'POST',
    body: formData
  });
}

export const taxonomyApi = {
  categories: `${apiUrl}?resource=categories`,
  subcategories: (categoryId: string) => (
    `${apiUrl}?resource=subcategories&category_id=${encodeURIComponent(categoryId)}`
  )
};
