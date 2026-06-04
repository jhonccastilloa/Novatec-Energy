import { createRoot } from 'react-dom/client';
import { ProductTaxonomySelects } from './product-taxonomy/ProductTaxonomySelects';
import './product-taxonomy.css';

document.querySelectorAll<HTMLElement>('[data-product-taxonomy]').forEach((root) => {
  createRoot(root).render(<ProductTaxonomySelects root={root} />);
});
