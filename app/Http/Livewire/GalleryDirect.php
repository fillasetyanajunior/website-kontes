<?php

namespace App\Http\Livewire;

use App\Models\MessageComentar;
use App\Mail\HandoverCommentMail;
use App\Mail\PublicDiscussionMail;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\ReplayPublicDiscus;
use App\Models\ResultProject;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GalleryDirect extends Component
{
    public $project, $messagereply = null, $feedback;
    public $search = null;
    protected $queryString = ['search'];

    public function mount($project)
    {
        $this->project = $project;
        $this->search = request()->query('search', $this->search);
    }

    public function MessageComentar($id)
    {
        if ($this->messagereply == null) {
            $project    = Project::where('id', $id)->first();
            $comentar   = MessageComentar::where('result_id', $id)->first();
            if ($comentar != '') {
                $MessageComentar = MessageComentar::create([
                    'result_id' => $id,
                    'user_id'   => request()->user()->id,
                    'feedback'  => $this->feedback,
                ]);

                $kirimnotifcomentar  = MessageComentar::where('result_id', $id)->distinct()->get('user_id');

                for ($i = 0; $i < count($kirimnotifcomentar); $i++) {
                    if (request()->user()->id != $kirimnotifcomentar[$i]->user_id) {
                        NewsFeed::create([
                            'contest_id'    => $id,
                            'user_id_from'  => request()->user()->id,
                            'user_id_to'    => $kirimnotifcomentar[$i]->user_id,
                            'feedback'      => $this->feedback,
                            'choices'       => 'comment public',
                        ]);
                        $worker = User::where('id', $kirimnotifcomentar[$i]->user_id)->first();
                        Mail::to($worker->email)->send(new PublicDiscussionMail($this->feedback, $project->title));
                        Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                            'number' => $worker->phone,
                            'message' =>    'You get a comment from the contest ' . $project->title
                        ]);
                    }
                }
            } else {
                MessageComentar::create([
                    'result_id' => $id,
                    'user_id'   => request()->user()->id,
                    'feedback'  => $this->feedback,
                ]);

                NewsFeed::create([
                    'contest_id'    => $id,
                    'user_id_from'  => request()->user()->id,
                    'user_id_to'    => $project->user_id,
                    'feedback'      => $this->feedback,
                    'choices'       => 'comment public',
                ]);
                $customer = User::where('id', $project->user_id)->first();
                Mail::to($customer->email)->send(new PublicDiscussionMail($this->feedback, $project->title));
                Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                    'number' => $customer->phone,
                    'message' =>    'You get a comment from the contest ' . $project->title
                ]);
            }
        } else {
            ReplayPublicDiscus::create([
                'message_replay'    => $this->messagereply,
                'user_id'           => request()->user()->id,
                'feedback'          => $this->feedback,
            ]);
            $this->messagereply = null;
        }
        $this->feedback = '';
    }

    public function Replay($messages)
    {
        $this->messagereply = $messages;
    }

    public function render()
    {
        if (request()->user()->role == 'customer' || request()->user()->role == 'admin') {
            if ($this->search == null) {
                $data['resultdirect'] = ResultProject::orderBy('is_active', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
            } else {
                if ($this->search == 1) {
                    $data['resultdirect'] = ResultProject::orderBy('is_active', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                } elseif ($this->search == 2) {
                    $data['resultdirect'] = ResultProject::where('is_active', 'active')->where('contest_id', $this->project->id)->paginate(20);
                } elseif ($this->search == 3) {
                    $data['resultdirect'] = ResultProject::orderBy('nilai', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                } elseif ($this->search == 4) {
                    $data['resultdirect'] = ResultProject::where('is_active', 'eliminasi')->where('contest_id', $this->project->id)->paginate(20);
                } elseif ($this->search == 5) {
                    $data['resultdirect'] = ResultProject::orderBy('is_active', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                } elseif ($this->search == 6) {
                    $data['resultdirect'] = ResultProject::orderBy('nilai', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                } else {
                    $data['resultdirect'] = ResultProject::orderBy('created_at', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                }
            }
        } else {
            if ($this->project->is_active == 'running') {
                $data['resultdirect'] = ResultProject::orderBy('is_active', 'DESC')->where('contest_id', $this->project->id)->where('user_id_worker', request()->user()->id)->paginate(20);
            } else {
                if ($this->search == null) {
                    $data['resultdirect'] = ResultProject::orderBy('is_active', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                } else {
                    if ($this->search == 1) {
                        $data['resultdirect'] = ResultProject::orderBy('is_active', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                    } elseif ($this->search == 2) {
                        $data['resultdirect'] = ResultProject::where('is_active', 'active')->where('contest_id', $this->project->id)->paginate(20);
                    } elseif ($this->search == 3) {
                        $data['resultdirect'] = ResultProject::orderBy('nilai', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                    } elseif ($this->search == 4) {
                        $data['resultdirect'] = ResultProject::where('is_active', 'eliminasi')->where('contest_id', $this->project->id)->paginate(20);
                    } elseif ($this->search == 5) {
                        $data['resultdirect'] = ResultProject::orderBy('is_active', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                    } elseif ($this->search == 6) {
                        $data['resultdirect'] = ResultProject::orderBy('nilai', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                    } else {
                        $data['resultdirect'] = ResultProject::orderBy('created_at', 'DESC')->where('contest_id', $this->project->id)->paginate(20);
                    }
                }
            }
        }
        $data['message'] = MessageComentar::where('result_id', $this->project->id)->get();
        return view('livewire.gallery-direct',$data);
    }
}
