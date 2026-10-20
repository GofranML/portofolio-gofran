<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Agent;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReaPortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_portfolio_page_loads_successfully_with_rea_data(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Gofran Muttaqi Likhan');
        $response->assertSee('Hyper-Local Air Quality Mapping');
        $response->assertSee('Website Penjualan Toyota dengan AI Chatbot');
        $response->assertSee('PT. Bangka Cakra Karya');
        $response->assertSee('ITB PalComTech');
        $response->assertSee('Tersedia untuk bekerjasama');
        $response->assertDontSee('Tersedia untuk magang');
        $response->assertDontSee('Ontologi REA');
        $response->assertDontSee('Formulir Penawaran');
        $response->assertDontSee('REA Architecture');
        $response->assertDontSee('REA Active:');
        $response->assertDontSee('rea-tag');

        // Test consecutive request
        $secondResponse = $this->get('/');
        $secondResponse->assertStatus(200);
        $secondResponse->assertSee('Gofran Muttaqi Likhan');
    }

    public function test_rea_api_endpoint_returns_valid_ontology_graph(): void
    {
        $response = $this->getJson('/api/rea-graph');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'meta' => ['model', 'application', 'framework', 'timestamp'],
            'agents' => [
                '*' => ['id', 'name', 'type', 'role', 'events_participated'],
            ],
            'resources' => [
                '*' => ['id', 'title', 'type', 'category', 'events_associated'],
            ],
            'events' => [
                '*' => ['id', 'title', 'type', 'organization', 'agent', 'resources_involved', 'period'],
            ],
        ]);
    }

    public function test_visitor_can_submit_collaboration_inquiry_and_create_rea_event_and_agent(): void
    {
        $payload = [
            'name' => 'Dr. Hendra Wijaya',
            'email' => 'hendra@techcorp.id',
            'organization' => 'TechCorp Indonesia',
            'phone' => '081234567890',
            'subject' => 'Tawaran Bekerjasama Riset IoT & AI',
            'message' => 'Kami sangat tertarik dengan proyek Air Quality Mapping Anda dan ingin mengundang Anda wawancara kerjasama.',
        ];

        $response = $this->postJson('/inquiry', $payload);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
        ]);

        // Assert External Agent was created in REA model
        $this->assertDatabaseHas('agents', [
            'name' => 'Dr. Hendra Wijaya',
            'email' => 'hendra@techcorp.id',
            'type' => 'external',
            'company_name' => 'TechCorp Indonesia',
        ]);

        // Assert Event was recorded in REA model
        $this->assertDatabaseHas('events', [
            'title' => 'Inquiry: Tawaran Bekerjasama Riset IoT & AI',
            'type' => 'contact_inquiry',
            'organization' => 'TechCorp Indonesia',
        ]);
    }

    public function test_inquiry_validation_rules_are_enforced(): void
    {
        $response = $this->postJson('/inquiry', [
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => 'short',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_featured_project_has_preview_gallery_and_modal_assets(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('btn-preview-hyper-local-air-quality-mapping');
        $response->assertSee('Lihat Hasil Proyek (3 Layar)');
        $response->assertSee('Dashboard Admin');
        $response->assertSee('Dashboard Publik');
        $response->assertSee('Login Admin');
        $response->assertSee('projectGalleryModal');
        $response->assertSee('dashbord_admin_pollutrack.jpg');
        $response->assertSee('dashbord_publik_pollutrack.jpg');
        $response->assertSee('login_admin_pollutrack.jpg');

        $this->assertFileExists(public_path('images/pollutrack/dashbord_admin_pollutrack.jpg'));
        $this->assertFileExists(public_path('images/pollutrack/dashbord_publik_pollutrack.jpg'));
        $this->assertFileExists(public_path('images/pollutrack/login_admin_pollutrack.jpg'));
    }
}
