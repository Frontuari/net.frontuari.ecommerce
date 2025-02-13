<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'titulo' => 'Terminos y condiciones',
                'body' => '<p><!-- [if gte mso 9]><xml>
<o:OfficeDocumentSettings>
<o:RelyOnVML/>
<o:AllowPNG/>
</o:OfficeDocumentSettings>
</xml><![endif]--><!-- [if gte mso 9]><xml>
<w:WordDocument>
<w:View>Normal</w:View>
<w:Zoom>0</w:Zoom>
<w:TrackMoves/>
<w:TrackFormatting/>
<w:HyphenationZone>21</w:HyphenationZone>
<w:PunctuationKerning/>
<w:ValidateAgainstSchemas/>
<w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
<w:IgnoreMixedContent>false</w:IgnoreMixedContent>
<w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
<w:DoNotPromoteQF/>
<w:LidThemeOther>ES-VE</w:LidThemeOther>
<w:LidThemeAsian>X-NONE</w:LidThemeAsian>
<w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
<w:Compatibility>
<w:BreakWrappedTables/>
<w:SnapToGridInCell/>
<w:WrapTextWithPunct/>
<w:UseAsianBreakRules/>
<w:DontGrowAutofit/>
<w:SplitPgBreakAndParaMark/>
<w:EnableOpenTypeKerning/>
<w:DontFlipMirrorIndents/>
<w:OverrideTableStyleHps/>
</w:Compatibility>
<m:mathPr>
<m:mathFont m:val="Cambria Math"/>
<m:brkBin m:val="before"/>
<m:brkBinSub m:val="&#45;-"/>
<m:smallFrac m:val="off"/>
<m:dispDef/>
<m:lMargin m:val="0"/>
<m:rMargin m:val="0"/>
<m:defJc m:val="centerGroup"/>
<m:wrapIndent m:val="1440"/>
<m:intLim m:val="subSup"/>
<m:naryLim m:val="undOvr"/>
</m:mathPr></w:WordDocument>
</xml><![endif]--><!-- [if gte mso 9]><xml>
<w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
DefSemiHidden="false" DefQFormat="false" DefPriority="99"
LatentStyleCount="376">
<w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>
<w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 1"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 2"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 3"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 4"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 5"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 6"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 7"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 8"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 9"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 7"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 8"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 9"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 1"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 2"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 3"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 4"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 5"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 6"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 7"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 8"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 9"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Normal Indent"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="footnote text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="annotation text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="header"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="footer"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index heading"/>
<w:LsdException Locked="false" Priority="35" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="caption"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="table of figures"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="envelope address"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="envelope return"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="footnote reference"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="annotation reference"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="line number"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="page number"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="endnote reference"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="endnote text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="table of authorities"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="macro"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="toa heading"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 5"/>
<w:LsdException Locked="false" Priority="10" QFormat="true" Name="Title"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Closing"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Signature"/>
<w:LsdException Locked="false" Priority="1" SemiHidden="true"
UnhideWhenUsed="true" Name="Default Paragraph Font"/>
<w:LsdException Locked="false" Priority="1" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="Body Text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text Indent"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Message Header"/>
<w:LsdException Locked="false" Priority="11" QFormat="true" Name="Subtitle"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Salutation"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Date"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text First Indent"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text First Indent 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Note Heading"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text Indent 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text Indent 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Block Text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Hyperlink"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="FollowedHyperlink"/>
<w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>
<w:LsdException Locked="false" Priority="20" QFormat="true" Name="Emphasis"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Document Map"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Plain Text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="E-mail Signature"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Top of Form"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Bottom of Form"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Normal (Web)"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Acronym"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Address"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Cite"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Code"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Definition"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Keyboard"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Preformatted"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Sample"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Typewriter"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Variable"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Normal Table"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="annotation subject"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="No List"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Outline List 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Outline List 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Outline List 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Simple 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Simple 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Simple 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Colorful 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Colorful 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Colorful 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 7"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 8"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 7"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 8"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table 3D effects 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table 3D effects 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table 3D effects 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Contemporary"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Elegant"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Professional"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Subtle 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Subtle 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Web 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Web 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Web 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Balloon Text"/>
<w:LsdException Locked="false" Priority="39" Name="Table Grid"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Theme"/>
<w:LsdException Locked="false" SemiHidden="true" Name="Placeholder Text"/>
<w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
<w:LsdException Locked="false" Priority="61" Name="Light List"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
<w:LsdException Locked="false" SemiHidden="true" Name="Revision"/>
<w:LsdException Locked="false" Priority="34" QFormat="true"
Name="List Paragraph"/>
<w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
<w:LsdException Locked="false" Priority="30" QFormat="true"
Name="Intense Quote"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
<w:LsdException Locked="false" Priority="19" QFormat="true"
Name="Subtle Emphasis"/>
<w:LsdException Locked="false" Priority="21" QFormat="true"
Name="Intense Emphasis"/>
<w:LsdException Locked="false" Priority="31" QFormat="true"
Name="Subtle Reference"/>
<w:LsdException Locked="false" Priority="32" QFormat="true"
Name="Intense Reference"/>
<w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
<w:LsdException Locked="false" Priority="37" SemiHidden="true"
UnhideWhenUsed="true" Name="Bibliography"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
<w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
<w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
<w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
<w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
<w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
<w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
<w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
<w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
<w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 1"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 2"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 3"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 4"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 5"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 6"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 6"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 6"/>
<w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
<w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
<w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 1"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 2"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 3"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 4"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 5"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 6"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 6"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Mention"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Smart Hyperlink"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Hashtag"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Unresolved Mention"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Smart Link"/>
</w:LatentStyles>
</xml><![endif]--><!-- [if gte mso 10]>
<style>
/* Style Definitions */
table.MsoNormalTable
{mso-style-name:"Tabla normal";
mso-tstyle-rowband-size:0;
mso-tstyle-colband-size:0;
mso-style-noshow:yes;
mso-style-priority:99;
mso-style-parent:"";
mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
mso-para-margin-top:0cm;
mso-para-margin-right:0cm;
mso-para-margin-bottom:8.0pt;
mso-para-margin-left:0cm;
line-height:107%;
mso-pagination:widow-orphan;
font-size:11.0pt;
font-family:"Calibri",sans-serif;
mso-ascii-font-family:Calibri;
mso-ascii-theme-font:minor-latin;
mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;
mso-fareast-language:EN-US;}
</style>
<![endif]--></p>
<p class="MsoNormal" style="text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Por favor lea los t&eacute;rminos y condiciones detenidamente antes de registrarse en la aplicaci&oacute;n m&oacute;vil y/o sitio web. </span></strong></p>
<p class="MsoNormal" style="text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Para efectos de los presentes T&eacute;rminos y condiciones, se establecen las siguientes definiciones: </span></strong></p>
<p class="MsoBodyText" style="margin-right: 5.55pt; text-align: justify; line-height: 150%; tab-stops: 132.0pt 244.25pt 345.65pt 349.4pt 355.55pt 369.45pt;"><strong style="mso-bidi-font-weight: normal;"><u><span lang="ES" style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">APP:</span></u></strong> <span lang="ES" style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">Se refiere a la aplicaci&oacute;n o programa denominado BIO EN L&Iacute;NEA, </span><span lang="ES" style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">que se instala en un dispositivo m&oacute;vil, dise&ntilde;ada para efectos del presente contrato. </span><u></u></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm .0001pt 13.25pt;"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Comercio Virtual:</span></u></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;"> C<span style="background: white;">onsiste en la compra y venta de&nbsp;</span></span><span style="color: black; mso-color-alt: windowtext;"><a title="Producto (marketing)" href="https://es.wikipedia.org/wiki/Producto_(marketing)"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white; text-decoration: none; text-underline: none;">productos</span></a></span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">&nbsp;y/o </span><span style="color: black; mso-color-alt: windowtext;"><a title="Servicio (econom&iacute;a)" href="https://es.wikipedia.org/wiki/Servicio_(econom%C3%ADa)"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white; text-decoration: none; text-underline: none;">servicios</span></a></span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">&nbsp;a trav&eacute;s de medios electr&oacute;nicos, concertado entre los usuarios y Biomercados. </span></p>
<p class="MsoNormal" style="margin-left: 13.25pt; text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Usuario: </span></u></strong><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Toda persona natural o jur&iacute;dica registrada en la APP, que </span><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">como destinatario final, haga uso de la APP para adquirir los productos y servicios ofertados. </span></p>
<p class="MsoNormal" style="margin-left: 13.25pt; text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">Biomercados: </span></u></strong><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">Operador propietario de la APP que ofrece sus servicios o productos en la modalidad de comercio electr&oacute;nico. </span></p>
<p class="MsoNormal" style="margin-left: 13.25pt; text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">Pedido:</span></u></strong><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;"> Resultado de productos finales que el usuario solicita a trav&eacute;s de la APP. </span></p>
<p class="MsoNormal" style="margin-left: 13.25pt; text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">Delivery:</span></u></strong><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;"> Acci&oacute;n de entregar el pedido al domicilio o direcci&oacute;n pre registrada en la cuenta del usuario. </span></p>
<p class="MsoNormal" style="margin-left: 13.25pt; text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1; background: white;">Empresa de delivery:</span></u></strong><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;"> Persona jur&iacute;dica diferente a Biomercados contratada para prestar el servicio de Delivery a los usuarios que soliciten sus pedidos a trav&eacute;s de la APP.<span style="mso-spacerun: yes;">&nbsp; </span></span></p>
<p class="MsoNormal" style="text-align: justify; line-height: 150%;"><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">&nbsp;</span></p>
<p class="MsoNormal" style="text-align: justify; text-indent: 13.25pt; line-height: 150%;"><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">El presente documento rige la utilizaci&oacute;n de la aplicaci&oacute;n en Internet BIO EN L&Iacute;NEA denominada en lo sucesivo la <strong style="mso-bidi-font-weight: normal;">APP, </strong>en la cual un <strong style="mso-bidi-font-weight: normal;">Usuario </strong>adquiere los productos y servicios ofrecidos por<strong style="mso-bidi-font-weight: normal;"> Biomercados </strong>a trav&eacute;s de la APP como comercio electr&oacute;nico, originando as&iacute; un contrato de compra y venta entre el Usuario y Biomercados, regulado bajo los siguientes t&eacute;rminos y condiciones: </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">PRIMERA. Objeto: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1; mso-bidi-font-weight: bold;">Con la celebraci&oacute;n del presente contrato se autoriza el uso de la<strong> APP, </strong>para que </span><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">El Usuario </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">estando en territorio nacional o en el extranjero, </span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">ingrese y se informe sobre los productos de consumo y servicios exhibidos a modo de referencia y pueda adquirirlos pagando una contraprestaci&oacute;n econ&oacute;mica, pudiendo adem&aacute;s solicitar la gesti&oacute;n de un encargo para ser entregado como Delivery. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">Registro de la APP</span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">: Cualquier persona natural o jur&iacute;dica legalmente capaz, podr&aacute; registrase como Usuario y hacer uso de la App de forma gratuita, mediante el registro de una cuenta personal, para ello deber&aacute; suministrar datos personales y una contrase&ntilde;a secreta que le permitir&aacute; el acceso a la APP, la cual podr&aacute; ser modificada por el usuario cuando lo considere necesario y en caso de extrav&iacute;o u olvido podr&aacute; regenerarla mediante la opci&oacute;n <span style="background: yellow; mso-highlight: yellow;">&iquest;Olvid&oacute; contrase&ntilde;a?</span> </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">El registro en la APP le atribuye la condici&oacute;n de Usuario e implica la aceptaci&oacute;n plena de todos los t&eacute;rminos y condiciones vigentes en el momento del ingreso a la APP. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Tratamiento de datos personales: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1; mso-bidi-font-weight: bold;">Biomercados </span><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">garantiza la seguridad y confiabilidad de informaci&oacute;n suministrada por el Usuario a trav&eacute;s de la APP, sin embargo, no se hace responsable por cualquier violaci&oacute;n o usurpaci&oacute;n que el sistema de seguridad del sitio que pueda sufrir por terceras personas, fallas en el sistema, servidor, internet o cualquier virus que pudiese alojarse en el sistema. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">El Usuario autoriza a Biomercados, a facilitar a cualquier tercero afectado, aseguradora o autoridad judicial la informaci&oacute;n que este a su alcance incluidos los datos personales en caso de reclamos, quejas o litigios en que el Usuario se encuentre implicado. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Suspensi&oacute;n y cancelaci&oacute;n de cuentas de Usuarios: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Biomercados se reserva el derecho y a su entera discreci&oacute;n de suspender la cuenta de un usuario cuando: 1) este no cumpla con las exigencias para el registro en la APP;<span style="mso-spacerun: yes;">&nbsp; </span>2) considere que existen razones fundadas para pensar que la cuenta fue usada o est&aacute; siendo utilizada para fines ilegales, fraudulentos, deshonestos o que violen alguno de los t&eacute;rminos y condiciones aqu&iacute; establecidos; 3) su interacci&oacute;n en la App sea contraria a la moral y buenas costumbres, haga uso de<span style="mso-spacerun: yes;">&nbsp; </span>un lenguaje soez en contra de Biomercados u otros usuarios. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Productos Ofertados: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Los productos ofertados en la presente APP son im&aacute;genes referenciales que le permiten al usuario tener una mejor identificaci&oacute;n de los productos, proporcionando la mayor exactitud en cuanto a la calidad de la imagen, colores y descripci&oacute;n, por cuanto cualquier error en ello, letras o s&iacute;mbolos implique perjuicio alguno en el producto. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Servicio Delivery o entrega a domicilio: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">a) Los productos se entregar&aacute;n &uacute;nicamente en el territorio de la Rep&uacute;blica Bolivariana de Venezuela, cuidad de <span style="background: yellow; mso-highlight: yellow;">Valencia, parroquia San Jos&eacute;, Estado Carabobo</span> y se entregar&aacute;n en la direcci&oacute;n se&ntilde;ala por el Usuario, la cual debe estar previamente definida en su cuenta</span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">; b)</span> <span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Biomercados<span style="mso-spacerun: yes;">&nbsp; </span>podr&aacute; contratar los servicios de otras empresas de delivery<span style="mso-spacerun: yes;">&nbsp; </span>para hacer la entrega de los pedidos realizados por los usuarios a trav&eacute;s de la APP, en cuyo caso Biomercados<span style="mso-spacerun: yes;">&nbsp; </span>no se hace responsable por cualquier evento de caso fortuito o fuerza mayor que suceda durante la entrega de los pedidos, siendo la empresa de delivery la &uacute;nica responsable por los da&ntilde;os y perjuicios ocasionados a los usuarios, siempre y cuando la situaci&oacute;n se produzca una vez que los productos se encuentren bajo la potestad de la empresa de delivery<span style="mso-spacerun: yes;">&nbsp; </span>y/o por causas imputables a ella. </span><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;"><span style="mso-spacerun: yes;">&nbsp;</span>D) Queda a discreci&oacute;n de Biomercados, el tipo de veh&iacute;culo a emplear para la entrega del pedido, esto depender&aacute; del volumen del mismo. E) <a name="_Hlk37063152"></a><span style="mso-bidi-font-weight: bold;">Biomercados </span>no ser&aacute; responsable en caso de que la entrega del pedido no pueda realizarse por la inexactitud de la direcci&oacute;n predefinida en la cuenta del Usuario, o de ser esta incorrecta o incompleta, por cuanto ser&aacute; por cuenta del Usuario cualquier recargo que esto pueda originar. </span></p>
<p class="MsoNormal" style="text-align: justify; line-height: 150%;"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Forma de pago:</span></strong><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;"> Para concretar la compra del pedido e</span><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">l Usuario podr&aacute; escoger y seleccionar el medio de pago disponible en la APP, todos los productos incluir&aacute;n los impuestos aplicables exigidos conforme a la legislaci&oacute;n. </span><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">El usuario entiende y acepta que la solicitud de un pedido mediante el servicio Delivery genera cargos, cuyo costo se indicar&aacute; al </span><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">momento de realizar la compra en l&iacute;nea.</span></p>
<p class="MsoNormal" style="text-align: justify; line-height: 150%;"><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;"><span style="mso-spacerun: yes;">&nbsp;</span><span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>El </span><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">despacho de los pedidos depender&aacute; de la confirmaci&oacute;n del pago efectivamente realizado, por cuanto Biomercados </span><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">podr&aacute; anular o suspender la entrega del pedido, en caso de no comprobarse o concretarse el pago correspondiente del pedido solicitado.<span style="mso-spacerun: yes;">&nbsp; </span></span></p>
<p class="MsoNormal" style="text-align: justify; text-indent: 35.4pt; line-height: 150%;"><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Biomercados no se hace responsable en </span><span style="font-size: 12.0pt; line-height: 150%; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">relaci&oacute;n a las fallas que pudieran suscitarse en el sistema de pago, trasferencias devueltas, servicios de la banca o cualquier otro particular referente al pago. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">Obligaciones del Usuario:</span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;"> Con la suscripci&oacute;n del presente contrato el Usuario se obliga a: 1) Suministrar en forma veraz, exacta y fidedigna, toda la informaci&oacute;n solicitada<span style="mso-spacerun: yes;">&nbsp; </span>para el registro en la App; 2) hacer uso de la APP en forma <span style="mso-spacerun: yes;">&nbsp;</span>personal e<span style="background: white;"> intransferible, por cuanto no podr&aacute; ceder los datos de validaci&oacute;n para su acceso, ni el uso de su cuenta a ning&uacute;n tercero; 3) mantener actualizados los datos personales requeridos en la App; 4) </span></span><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">el usuario ser&aacute; el &uacute;nico responsable de la confidencialidad de su correo electr&oacute;nico y contrase&ntilde;a, debiendo informar inmediatamente el uso no autorizado de los mismos o en cualquier caso de problemas de seguridad, en ning&uacute;n caso <strong>Biomercados, </strong>ni sus empleados o asociados, ser&aacute;n responsables del uso indebido que el Usuario pudiere hacer de su cuenta; 5)</span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;"> Pagar oportunamente la contraprestaci&oacute;n econ&oacute;mica definida conforme al pedido realizado; 6) exhibir la identificaci&oacute;n en caso de venta de productos de uso restringido; 7) </span><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;"><span style="mso-spacerun: yes;">&nbsp;</span></span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">En general realizar todas aquellas conductas necesarias para la ejecuci&oacute;n de un acto de compra y venta. </span></p>
<p style="text-align: justify; text-indent: 35.4pt; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">El Usuario deber&aacute; abstenerse de: 1) utilizar la APP para realizar actos contrarios a la moral, la ley, el orden p&uacute;blico y buenas costumbres; 2) Utilizar la App con fines fraudulentos o efectos il&iacute;citos, contrarios a lo establecido en los presentes t&eacute;rminos y condiciones, lesivos de los derechos e intereses de terceros; 3) introducir o difundir virus inform&aacute;ticos o cualquier otros sistemas, que puedan provocar da&ntilde;os a la App, Biomercados u otros usuarios; 4) reproducir, copiar, distribuir, transformar o modificar la APP, logos, gr&aacute;ficos o cualquier imagen propiedad de Biomercados. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">Obligaciones de Biomercados: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">En virtud de los presentes t&eacute;rminos&nbsp;</span><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;"> Biomercados </span></strong><strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;"><span style="mso-spacerun: yes;">&nbsp;</span></span></strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1; mso-bidi-font-weight: bold;">se compromete a: 1) Suministrar informaci&oacute;n clara y suficiente de los productos que exhibe a trav&eacute;s de la APP; 2)</span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;"> Indicar las caracter&iacute;sticas&nbsp;generales de los productos, para que sirvan de referencia; 3) Informar sobre los medios de pago disponibles para el Usuario; 4) Utilizar la informaci&oacute;n &uacute;nicamente para los fines establecidos en los presentes t&eacute;rminos; 5) Biomercados </span><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">no se responsabiliza por la certeza de los datos personales provistos por los Usuarios, por ende el Usuario garantizar&aacute; y responder&aacute;, en cualquier caso, de la veracidad, exactitud, vigencia y autenticidad de los datos personales ingresados; 6</span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">) Publicar a trav&eacute;s de la APP el horario de atenci&oacute;n a los usuarios, pudiendo modificarlos conforme a la legislaci&oacute;n que rigen la materia o cualquier otra circunstancia que pudiera afectar la prestaci&oacute;n del servicio. 7) <strong style="mso-bidi-font-weight: normal;">Biomercados</strong>, no ser&aacute; responsable por los productos o servicio ofrecidos por los diferentes proveedores que sean nocivos para la salud, causen alg&uacute;n da&ntilde;o o sean considerados il&iacute;citos. 8) <span style="mso-spacerun: yes;">&nbsp;</span>Biomercados se abstiene de realizar ventas de productos restringidos a menores de edad, en estos casos podr&aacute; solicitar la exhibici&oacute;n de las credenciales del Usuario. </span></p>
<p class="MsoNormal" style="line-height: 12.0pt; background: white; margin: 12.0pt 0cm 12.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 12.0pt; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">Reclamos y Devoluciones: </span></strong><span style="font-size: 12.0pt; font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">En caso que exista alg&uacute;n tipo de reclamo por parte de un usuario por la compra realizada a trav&eacute;s de la APP, este dispondr&aacute; de x d&iacute;as para formalizar el reclamo mediante xxxxxxxxxx, contados desde la fecha de recepci&oacute;n del producto. </span><span lang="ES-TRAD" style="font-size: 12.0pt; font-family: \'Arial Narrow\',sans-serif; mso-fareast-font-family: \'Times New Roman\'; mso-bidi-font-family: \'Times New Roman\'; color: black; mso-themecolor: text1; mso-ansi-language: ES-TRAD; mso-fareast-language: ES-VE;">Despu&eacute;s de ese plazo los productos ser&aacute;n considerados como conformes por el Usuario. </span></p>
<p class="MsoNormal" style="line-height: 12.0pt; background: white; margin: 12.0pt 0cm 12.0pt 0cm;"><span lang="ES-TRAD" style="font-size: 12.0pt; font-family: \'Arial Narrow\',sans-serif; mso-fareast-font-family: \'Times New Roman\'; mso-bidi-font-family: \'Times New Roman\'; color: black; mso-themecolor: text1; mso-ansi-language: ES-TRAD; mso-fareast-language: ES-VE;">Biomercados no se hace responsable y se reserva el derecho de rechazar posibles reclamos en caso de mercanc&iacute;a en mal estado por uso indebido o da&ntilde;os ocasionados durante el transporte o por mal manejo del usuario. </span></p>
<p class="MsoNormal" style="line-height: 12.0pt; background: white; margin: 12.0pt 0cm 12.0pt 0cm;"><span lang="ES-TRAD" style="font-size: 12.0pt; font-family: \'Arial Narrow\',sans-serif; mso-fareast-font-family: \'Times New Roman\'; mso-bidi-font-family: \'Times New Roman\'; color: black; mso-themecolor: text1; mso-ansi-language: ES-TRAD; mso-fareast-language: ES-VE;">En caso de proceder y ser aprobado el reclamo por Biomercados, el usuario podr&aacute; solicitar el cambio por otro producto de igual o mayor valor asumiendo el pago de la diferencia que resulte; En ning&uacute;n caso Biomercados har&aacute; reintegro de dinero en ninguna modalidad. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Fallas T&eacute;cnicas: <span style="mso-spacerun: yes;">&nbsp;</span></span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Biomercados no se responsabiliza por las fallas en el sistema, servicio el&eacute;ctrico, red de internet, retrasos o bloqueos causados por deficiencia o sobrecargas en el sistema o cualquier otra circunstancia que imposibilite o dificulte el acceso a la APP.</span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">Derechos de Propiedad Intelectual e Industrial: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">El Usuario reconoce y acepta que todos los derechos de propiedad intelectual e industrial sobre la APP o cualquier otro elemento insertado en esta, incluyendo sin limitaci&oacute;n, marcas, logotipos, nombres comerciales, textos, eslogan, im&aacute;genes, gr&aacute;ficos, dise&ntilde;os, sonidos, bases de datos, software, diagramas de flujo, audios, v&iacute;deos y cualquier otra, pertenecen &uacute;nica y exclusivamente a Biomercados o sus licenciantes.</span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin; color: black; mso-themecolor: text1;">El usuario podr&aacute; visualizar y descargar la App en su dispositivo m&oacute;vil, para los fines establecidos en los t&eacute;rminos y condiciones aqu&iacute; desarrollados, sin otros fines lucrativos, por cuanto el usuario no podr&aacute; realizar copias, reproducciones, modificaci&oacute;n alguna de los elementos all&iacute; insertados. El uso o explotaci&oacute;n de estos estar&aacute; sujeto a autorizaci&oacute;n escrita por parte de Biomercados.<span style="mso-spacerun: yes;">&nbsp; </span></span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">P&aacute;ginas Emergentes y Cookies: <span style="mso-spacerun: yes;">&nbsp;</span></span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">Con la aceptaci&oacute;n de los presentes t&eacute;rminos y condiciones e incluso con el hecho de hacer uso de la APP, el usuario acepta el uso de Cookies necesarios para almacenar informaci&oacute;n del usuario, realizar an&aacute;lisis de navegaci&oacute;n y en general brindar una mejor accesibilidad a la APP. <span style="mso-spacerun: yes;">&nbsp;</span></span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">Modificaciones en la APP: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">Biomercados podr&aacute; realizar las modificaciones en la App que considere pertinente, sin que ello implique previa notificaci&oacute;n o aceptaci&oacute;n de los usuarios. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">Comunicaci&oacute;n y Notificaciones: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Los Usuarios podr&aacute; dejar sus comentarios, dudas y sugerencias a trav&eacute;s de www.biomercados.com.ve, manteniendo siempre la moral y las buenas costumbres, hacia Biomercados y los dem&aacute;s usuarios, entendiendo que, al hacer sus publicaciones en la App o correo electr&oacute;nico, estas pasar&aacute;n a ser propiedad de Biomercados, es decir, ceden todos los derechos e intereses que pueden tener sobre la informaci&oacute;n publicada. </span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">El Usuario autoriza a Biomercados a realizar las notificaciones pertinentes a trav&eacute;s del correo electr&oacute;nico facilitado por el usuario al momento del registro en la APP, mediante mensajer&iacute;a de texto, WhatsApp o en cualquier de las direcciones predefinidas en su cuenta. Por su parte el Usuario podr&aacute; notificar a Biomercados a trav&eacute;s del correo electr&oacute;nico </span><span style="color: black; mso-color-alt: windowtext;"><a href="mailto:biomercadosenlinea@gmail.com">biomercadosenlinea@gmail.com</a></span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><strong style="mso-bidi-font-weight: normal;"><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">Aceptaci&oacute;n Total De Los T&eacute;rminos: </span></strong><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1; background: white;">El Usuario manifiesta expresamente tener la capacidad legal para el uso de la APP, manifiesta haber suministrado</span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;"> su informaci&oacute;n personal real, veraz y fidedigna y por ende <span style="background: white;">declara </span></span><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">haber le&iacute;do, estar de acuerdo y someterse a los presentes <strong>T&eacute;rminos y</strong> <strong>Condiciones</strong>, los cuales tienen un car&aacute;cter obligatorio y vinculante entre las partes, en caso contrario deber&aacute; abstenerse de utilizar la APP y/o los servicios prestados por &eacute;l. </span></p>
<p style="text-align: justify; text-indent: 35.4pt; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">En caso de hacer uso de la APP desde la ubicaci&oacute;n de otro pa&iacute;s diferente a Venezuela, el usuario declara aceptar y estar </span><span style="font-family: \'Arial Narrow\',sans-serif; mso-bidi-font-family: Arial; color: black; mso-themecolor: text1;">completamente sujeto a lo dispuesto en los presentes t&eacute;rminos.</span></p>
<p style="text-align: justify; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;"><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Los t&eacute;rminos y condiciones aqu&iacute; establecidos, se regir&aacute;n e interpretar&aacute;n de conformidad con la legislaci&oacute;n venezolana y las partes acuerdan someterse a la jurisdicci&oacute;n de la ciudad de valencia, estado Carabobo.</span></p>
<p style="text-align: center; line-height: 150%; background: white; margin: 0cm 0cm 18.0pt 0cm;" align="center"><span style="font-family: \'Arial Narrow\',sans-serif; color: black; mso-themecolor: text1;">Le damos la Bienvenida a Nuestra APP </span></p>',
'status' => 'A',
'imagen' => NULL,
'created_at' => '2020-04-15 20:31:55',
'updated_at' => '2020-04-15 20:31:55',
'observacion' => NULL,
),
1 => 
array (
'id' => 2,
'titulo' => 'Preguntas frecuentes',
'body' => '<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">&bull; <strong class="calibre3">&iquest;C&oacute;mo creo un usuario en la p&aacute;gina de biomercados?</strong></p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">Usted puede registrarse de forma sencilla, sigue los siguientes paso:</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">1. Haz clic en Registrarte (ubicado en la parte superior derecha)&nbsp;</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">2. Introduce los datos solicitados para la creaci&oacute;n de usuario.</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">&nbsp;</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">&bull; <strong class="calibre3">&iquest;C&oacute;mo puedo realizar mi compra online?</strong></p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">Usted podr&aacute; realizar su compra online siguiendo los siguientes pasos:</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">1.Ingresa en nuestra web</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">2.Reg&iacute;strate o ingresa con tu usuario.</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">3.Agregue los productos de su preferencia al carrito.</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">4.Clic en la opci&oacute;n finalizar su compra, ubicado en el carrito de compras.</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">5.Seleccione la opci&oacute;n (Delivery o Pick up) seg&uacute;n su preferencia, donde deber&aacute; suministrar los datos solicitados.</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">6.Seleccione la forma de pago (Transferencias, efectivo o pago con tarjetas debido o cr&eacute;dito)</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">7.Ingrese los datos de la referencia seg&uacute;n su m&eacute;todo de pago seleccionado.</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;">8.Confirme su pedido, haciendo clic en finalizar comprar.</p>
<p class="calibre1" style="margin: 1em 0px; color: #000000; font-family: \'Times New Roman\'; font-size: 16px;"><strong class="calibre3">NOTA: Al finalizar la transacci&oacute;n le llegar&aacute; autom&aacute;ticamente un</strong>&nbsp;<strong class="calibre3">correo de confirmaci&oacute;n de su pedido.</strong></p>',
'status' => 'A',
'imagen' => NULL,
'created_at' => '2020-04-15 20:37:39',
'updated_at' => '2020-04-15 20:37:39',
'observacion' => NULL,
),
2 => 
array (
'id' => 4,
'titulo' => 'Felicidades por su primera compra',
'body' => '<div style="text-align: center; background-color: #203876;"><img src="https://i.imgur.com/bqhoBSp.png" width="200" /></div>
<p>&nbsp;</p>
<div style="text-align: center;">Felicidades<br /><br /><hr /><a href="#">linksitio.com</a></div>', // TODO: Reemplazar por link del sitio web
'status' => 'A',
'imagen' => NULL,
'created_at' => '2020-04-15 23:26:31',
'updated_at' => '2020-04-15 23:35:32',
'observacion' => 'Enviado al correo en su 1ra compra',
),
3 => 
array (
'id' => 3,
'titulo' => 'Bienvenido',
'body' => '<div style="text-align: center; background-color: #203876;"><img src="https://i.imgur.com/bqhoBSp.png" width="200" /></div>
<p>&nbsp;</p>
<div style="text-align: center;">Bienvenido a Biomercados<br /><br /><hr /><a href="#">linksitio.com</a></div>',// TODO: Reemplazar por link del sitio web
'status' => 'A',
'imagen' => NULL,
'created_at' => '2020-04-15 23:25:12',
'updated_at' => '2020-04-15 23:36:06',
'observacion' => 'Enviado al correo luego de registrarse',
),
));
        
        
    }
}