-- Registra cambios reales para el sitemap sin asignar fechas a registros históricos.
-- Ejecutar una sola vez sobre la base de datos de producción, después de hacer backup.

ALTER TABLE `category`
  ADD COLUMN `updated_at` DATETIME NULL DEFAULT NULL AFTER `slug`;

ALTER TABLE `subcategory`
  ADD COLUMN `updated_at` DATETIME NULL DEFAULT NULL AFTER `slug`;

ALTER TABLE `productos`
  ADD COLUMN `updated_at` DATETIME NULL DEFAULT NULL AFTER `id_subcategory`;

DELIMITER //

CREATE TRIGGER `category_set_updated_at_before_insert`
BEFORE INSERT ON `category`
FOR EACH ROW
BEGIN
  IF NEW.`updated_at` IS NULL THEN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP;
  END IF;
END//

CREATE TRIGGER `category_set_updated_at_before_update`
BEFORE UPDATE ON `category`
FOR EACH ROW
BEGIN
  SET NEW.`updated_at` = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER `subcategory_set_updated_at_before_insert`
BEFORE INSERT ON `subcategory`
FOR EACH ROW
BEGIN
  IF NEW.`updated_at` IS NULL THEN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP;
  END IF;
END//

CREATE TRIGGER `subcategory_set_updated_at_before_update`
BEFORE UPDATE ON `subcategory`
FOR EACH ROW
BEGIN
  SET NEW.`updated_at` = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER `productos_set_updated_at_before_insert`
BEFORE INSERT ON `productos`
FOR EACH ROW
BEGIN
  IF NEW.`updated_at` IS NULL THEN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP;
  END IF;
END//

CREATE TRIGGER `productos_set_updated_at_before_update`
BEFORE UPDATE ON `productos`
FOR EACH ROW
BEGIN
  SET NEW.`updated_at` = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER `subcategory_touch_category_after_insert`
AFTER INSERT ON `subcategory`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = NEW.`id_category`;
END//

CREATE TRIGGER `subcategory_touch_category_after_update`
AFTER UPDATE ON `subcategory`
FOR EACH ROW
BEGIN
  UPDATE `category`
  SET `updated_at` = CURRENT_TIMESTAMP
  WHERE `id` IN (OLD.`id_category`, NEW.`id_category`);
END//

CREATE TRIGGER `subcategory_touch_category_after_delete`
AFTER DELETE ON `subcategory`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = OLD.`id_category`;
END//

CREATE TRIGGER `productos_touch_taxonomy_after_insert`
AFTER INSERT ON `productos`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = NEW.`id_categoria`;
  UPDATE `subcategory` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = NEW.`id_subcategory`;
END//

CREATE TRIGGER `productos_touch_taxonomy_after_update`
AFTER UPDATE ON `productos`
FOR EACH ROW
BEGIN
  UPDATE `category`
  SET `updated_at` = CURRENT_TIMESTAMP
  WHERE `id` IN (OLD.`id_categoria`, NEW.`id_categoria`);
  UPDATE `subcategory`
  SET `updated_at` = CURRENT_TIMESTAMP
  WHERE `id` IN (OLD.`id_subcategory`, NEW.`id_subcategory`);
END//

CREATE TRIGGER `productos_touch_taxonomy_after_delete`
AFTER DELETE ON `productos`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = OLD.`id_categoria`;
  UPDATE `subcategory` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = OLD.`id_subcategory`;
END//

DELIMITER ;
