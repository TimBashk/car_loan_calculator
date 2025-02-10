<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210124430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE claim (id INT AUTO_INCREMENT NOT NULL, payment_program_id INT DEFAULT NULL, car_id INT DEFAULT NULL, initial_payment INT NOT NULL, loan_term INT NOT NULL, monthly_payment INT NOT NULL, INDEX IDX_A769DE27B4E86DF (payment_program_id), INDEX IDX_A769DE27C3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_program (id INT AUTO_INCREMENT NOT NULL, interest_rate DOUBLE PRECISION NOT NULL, title VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE claim ADD CONSTRAINT FK_A769DE27B4E86DF FOREIGN KEY (payment_program_id) REFERENCES payment_program (id)');
        $this->addSql('ALTER TABLE claim ADD CONSTRAINT FK_A769DE27C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE claim DROP FOREIGN KEY FK_A769DE27B4E86DF');
        $this->addSql('ALTER TABLE claim DROP FOREIGN KEY FK_A769DE27C3C6F69F');
        $this->addSql('DROP TABLE claim');
        $this->addSql('DROP TABLE payment_program');
    }
}
