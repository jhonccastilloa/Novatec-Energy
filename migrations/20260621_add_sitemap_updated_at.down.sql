-- Reversión de 20260621_add_sitemap_updated_at.sql.
-- Elimina únicamente las fechas SEO; no modifica el catálogo.

DROP TRIGGER IF EXISTS `productos_touch_taxonomy_after_delete`;
DROP TRIGGER IF EXISTS `productos_touch_taxonomy_after_update`;
DROP TRIGGER IF EXISTS `productos_touch_taxonomy_after_insert`;
DROP TRIGGER IF EXISTS `subcategory_touch_category_after_delete`;
DROP TRIGGER IF EXISTS `subcategory_touch_category_after_update`;
DROP TRIGGER IF EXISTS `subcategory_touch_category_after_insert`;
DROP TRIGGER IF EXISTS `productos_set_updated_at_before_update`;
DROP TRIGGER IF EXISTS `productos_set_updated_at_before_insert`;
DROP TRIGGER IF EXISTS `subcategory_set_updated_at_before_update`;
DROP TRIGGER IF EXISTS `subcategory_set_updated_at_before_insert`;
DROP TRIGGER IF EXISTS `category_set_updated_at_before_update`;
DROP TRIGGER IF EXISTS `category_set_updated_at_before_insert`;

ALTER TABLE `productos` DROP COLUMN `updated_at`;
ALTER TABLE `subcategory` DROP COLUMN `updated_at`;
ALTER TABLE `category` DROP COLUMN `updated_at`;
