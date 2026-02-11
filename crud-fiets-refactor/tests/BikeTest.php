    <?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Models\Bike;

final class BikeTest extends TestCase
{
    public function testBikeHoldsData(): void
    {
        $bike = new Bike(1, 'Gazelle', 'Chamonix', 799, 'Fiets1c.jpg');

        $this->assertSame(1, $bike->id);
        $this->assertSame('Gazelle', $bike->merk);
        $this->assertSame('Chamonix', $bike->type);
        $this->assertSame(799, $bike->prijs);
        $this->assertSame('Fiets1c.jpg', $bike->foto);
    }
}
