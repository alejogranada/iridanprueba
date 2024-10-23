<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241022123045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Inserta los valores iniciales en la tabla area_contacto';
    }

    public function up(Schema $schema): void
    {
        // Aquí puedes insertar los valores iniciales en la tabla `area_contacto`
        $this->addSql("INSERT INTO area_contacto (nombre) VALUES ('Soporte')");
        $this->addSql("INSERT INTO area_contacto (nombre) VALUES ('Ventas')");
        $this->addSql("INSERT INTO area_contacto (nombre) VALUES ('Marketing')");
    }

    public function down(Schema $schema): void
    {
        // Para revertir el `up`, podrías eliminar los datos que has insertado
        $this->addSql("DELETE FROM area_contacto WHERE nombre IN ('Soporte', 'Ventas', 'Marketing')");
    }
}
