<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105135419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD meal_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('CREATE INDEX IDX_6BAF7870639666D6 ON ingredient (meal_id)');
        $this->addSql('ALTER TABLE instruction ADD meal_id INT NOT NULL');
        $this->addSql('ALTER TABLE instruction ADD CONSTRAINT FK_7BBAE156639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('CREATE INDEX IDX_7BBAE156639666D6 ON instruction (meal_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870639666D6');
        $this->addSql('DROP INDEX IDX_6BAF7870639666D6 ON ingredient');
        $this->addSql('ALTER TABLE ingredient DROP meal_id');
        $this->addSql('ALTER TABLE instruction DROP FOREIGN KEY FK_7BBAE156639666D6');
        $this->addSql('DROP INDEX IDX_7BBAE156639666D6 ON instruction');
        $this->addSql('ALTER TABLE instruction DROP meal_id');
    }
}
