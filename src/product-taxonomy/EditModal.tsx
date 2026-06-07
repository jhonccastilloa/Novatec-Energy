import type { FormEvent } from 'react';
import type { EditDialogState } from './types';

type EditModalProps = {
  dialog: EditDialogState | null;
  onCancel: () => void;
  onChange: (value: string) => void;
  onSave: (event: FormEvent<HTMLFormElement>) => void;
};

export function EditModal({ dialog, onCancel, onChange, onSave }: EditModalProps) {
  if (!dialog) return null;

  const title = dialog.type === 'category' ? 'Editar categoría' : 'Editar subcategoría';

  return (
    <div className="product-taxonomy-modal-backdrop" role="presentation">
      <div className="product-taxonomy-modal" role="dialog" aria-modal="true" aria-labelledby="taxonomyEditTitle">
        <form onSubmit={onSave}>
          <div className="product-taxonomy-modal-header">
            <h5 id="taxonomyEditTitle">{title}</h5>
          </div>
          <div className="product-taxonomy-modal-body">
            <label htmlFor="taxonomyEditInput">Nombre</label>
            <input
              id="taxonomyEditInput"
              type="text"
              className="form-control"
              value={dialog.value}
              onChange={(event) => onChange(event.target.value)}
              autoFocus
            />
            {dialog.error && (
              <div className="alert alert-danger py-2 product-taxonomy-modal-error">
                {dialog.error}
              </div>
            )}
          </div>
          <div className="product-taxonomy-modal-footer">
            <button type="button" className="btn btn-secondary" onClick={onCancel} disabled={dialog.saving}>
              Cancelar
            </button>
            <button type="submit" className="btn btn-primary" disabled={dialog.saving}>
              {dialog.saving ? 'Guardando...' : 'Editar'}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
