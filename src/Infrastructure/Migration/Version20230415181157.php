<?php

declare(strict_types=1);

namespace App\Infrastructure\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230415181157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add merchant entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE merchants (id UUID NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, registration_number VARCHAR(255) NOT NULL, tax_number VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN merchants.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN merchants.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE merchants');
    }
}
